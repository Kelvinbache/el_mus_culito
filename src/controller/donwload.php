<?php
namespace App\Controller;

require_once __DIR__ . '/../../vendor/tecnickcom/tcpdf/tcpdf.php';
require_once __DIR__ . '/../../config/Tables.php';

use PDO;

class PDFExportController {
    private $conn;
    
    public function __construct() {
        $db = new \Config\Tables();
        $this->conn = $db->exists_table();
    }

    /**
     * ========================================
     * SECTION 1: CLIENTS (type_user = 'user')
     * ========================================
     */
    public function pdf_clients() {
        try {
            // 1. GET DATA - ONLY CLIENTS
            $sql = "
                SELECT 
                    p.id_people,
                    p.user_name,
                    p.user_lastname,
                    p.user_dni,
                    p.user_email,
                    p.user_phone,
                    COUNT(DISTINCT m.id_membership) as total_memberships,
                    COUNT(DISTINCT a.id_attendance) as total_visits,
                    TO_CHAR(MAX(m.end_date), 'DD/MM/YYYY') as last_membership_end,
                    CASE 
                        WHEN MAX(m.end_date) >= CURRENT_DATE THEN 'Active'
                        ELSE 'Inactive'
                    END as membership_status
                FROM people p
                JOIN \"user\" u ON u.id_people = p.id_people
                LEFT JOIN membership m ON m.id_user = u.id_user
                LEFT JOIN attendance a ON a.id_user = u.id_user
                WHERE u.type_user = 'user'
                GROUP BY p.id_people, p.user_name, p.user_lastname, p.user_dni, p.user_email, p.user_phone
                ORDER BY p.user_name
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // 2. CREATE PDF
            $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            // IMPORTANT: Remove default headers/footers
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->setFontSubsetting(false);
            
            $pdf->SetCreator('El Mus-culito');
            $pdf->SetAuthor('Management System');
            $pdf->SetTitle('Clients Report');
            $pdf->SetMargins(15, 15, 15);
            $pdf->SetAutoPageBreak(TRUE, 15);
            $pdf->AddPage();
            
            // 3. HEADER
            $pdf->SetFont('helvetica', 'B', 20);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(0, 15, 'EL MUS-CULITO', 0, 1, 'C');
            
            $pdf->SetFont('helvetica', 'B', 16);
            $pdf->SetTextColor(223, 255, 0);
            $pdf->Cell(0, 10, 'CLIENTS REPORT', 0, 1, 'C');
            
            $pdf->SetFont('helvetica', '', 11);
            $pdf->SetTextColor(100, 100, 100);
            $pdf->Cell(0, 8, 'Date: ' . date('d/m/Y H:i:s'), 0, 1, 'C');
            $pdf->Cell(0, 8, 'Total clients: ' . count($clients), 0, 1, 'C');
            $pdf->Ln(10);
            
            // 4. HTML TABLE
            $html = '<style>
                        table {
                            border-collapse: collapse;
                            width: 100%;
                            font-family: helvetica;
                            font-size: 9px;
                        }
                        th {
                            background-color: #DFFF00;
                            color: black;
                            font-weight: bold;
                            padding: 6px;
                            text-align: center;
                            border: 1px solid #000000;
                        }
                        td {
                            padding: 4px;
                            border: 1px solid #000000;
                        }
                        tr:nth-child(even) {
                            background-color: #f2f2f2;
                        }
                        .active {
                            color: green;
                            font-weight: bold;
                        }
                        .inactive {
                            color: red;
                            font-weight: bold;
                        }
                    </style>';
            
            $html .= '<table cellpadding="4">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th width="6%">ID</th>';
            $html .= '<th width="10%">First Name</th>';
            $html .= '<th width="10%">Last Name</th>';
            $html .= '<th width="8%">DNI</th>';
            $html .= '<th width="15%">Email</th>';
            $html .= '<th width="10%">Phone</th>';
            $html .= '<th width="8%">Memberships</th>';
            $html .= '<th width="6%">Visits</th>';
            $html .= '<th width="12%">Last Membership</th>';
            $html .= '<th width="8%">Status</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            
            foreach ($clients as $c) {
                $last_membership = $c['last_membership_end'] ?? 'N/A';
                $status_class = strtolower($c['membership_status'] ?? 'inactive');
                $status_display = $c['membership_status'] ?? 'Inactive';
                
                $html .= '<tr>';
                $html .= '<td align="center">' . $c['id_people'] . '</td>';
                $html .= '<td>' . htmlspecialchars($c['user_name'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td>' . htmlspecialchars($c['user_lastname'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td>' . htmlspecialchars($c['user_dni'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td>' . htmlspecialchars($c['user_email'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td>' . htmlspecialchars($c['user_phone'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td align="center">' . ($c['total_memberships'] ?? 0) . '</td>';
                $html .= '<td align="center">' . ($c['total_visits'] ?? 0) . '</td>';
                $html .= '<td align="center">' . $last_membership . '</td>';
                $html .= '<td align="center"><span class="' . $status_class . '">' . $status_display . '</span></td>';
                $html .= '</tr>';
            }
            
            $html .= '</tbody>';
            $html .= '</table>';
            
            // 5. WRITE HTML AND DOWNLOAD
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('mus_culito_clients_' . date('Y-m-d') . '.pdf', 'D');
            exit;
            
        } catch (\Exception $e) {
            error_log("Error in pdf_clients: " . $e->getMessage());
            echo "Error generating PDF: " . $e->getMessage();
            exit;
        }
    }

    /**
     * ========================================
     * SECTION 2: EMPLOYEES (type_user = 'employee' OR 'admin')
     * ========================================
     */
    public function pdf_employees() {
        try {
            // 1. GET DATA - ONLY EMPLOYEES AND ADMINS
            $sql = "
                SELECT 
                    u.id_user,
                    p.user_name,
                    p.user_lastname,
                    p.user_dni,
                    p.user_email,
                    p.user_phone,
                    u.type_user,
                    COUNT(DISTINCT c.id_class) as total_classes,
                    COUNT(DISTINCT m.id_machine) as total_machines_assigned,
                    STRING_AGG(DISTINCT c.class_name, ', ') as class_list
                FROM \"user\" u
                JOIN people p ON u.id_people = p.id_people
                LEFT JOIN class c ON c.employee = u.id_user
                LEFT JOIN machines m ON m.id_employee = u.id_user
                WHERE u.type_user IN ('employee', 'admin')
                GROUP BY u.id_user, p.user_name, p.user_lastname, p.user_dni, p.user_email, p.user_phone, u.type_user
                ORDER BY p.user_name
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // 2. CREATE PDF
            $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            // IMPORTANT: Remove default headers/footers
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->setFontSubsetting(false);
            
            $pdf->SetCreator('El Mus-culito');
            $pdf->SetAuthor('Management System');
            $pdf->SetTitle('Employees Report');
            $pdf->SetMargins(15, 15, 15);
            $pdf->SetAutoPageBreak(TRUE, 15);
            $pdf->AddPage();
            
            // 3. HEADER
            $pdf->SetFont('helvetica', 'B', 20);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(0, 15, 'EL MUS-CULITO', 0, 1, 'C');
            
            $pdf->SetFont('helvetica', 'B', 16);
            $pdf->SetTextColor(223, 255, 0);
            $pdf->Cell(0, 10, 'EMPLOYEES REPORT', 0, 1, 'C');
            
            $pdf->SetFont('helvetica', '', 11);
            $pdf->SetTextColor(100, 100, 100);
            $pdf->Cell(0, 8, 'Date: ' . date('d/m/Y H:i:s'), 0, 1, 'C');
            $pdf->Cell(0, 8, 'Total employees: ' . count($employees), 0, 1, 'C');
            $pdf->Ln(10);
            
            // 4. HTML TABLE
            $html = '<style>
                        table {
                            border-collapse: collapse;
                            width: 100%;
                            font-family: helvetica;
                            font-size: 9px;
                        }
                        th {
                            background-color: #DFFF00;
                            color: black;
                            font-weight: bold;
                            padding: 6px;
                            text-align: center;
                            border: 1px solid #000000;
                        }
                        td {
                            padding: 4px;
                            border: 1px solid #000000;
                        }
                        tr:nth-child(even) {
                            background-color: #f2f2f2;
                        }
                        .admin {
                            background-color: #000000;
                            color: #DFFF00;
                            font-weight: bold;
                            padding: 2px 6px;
                            border-radius: 3px;
                        }
                        .employee {
                            background-color: #DFFF00;
                            color: #000000;
                            font-weight: bold;
                            padding: 2px 6px;
                            border-radius: 3px;
                        }
                    </style>';
            
            $html .= '<table cellpadding="4">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th width="6%">ID</th>';
            $html .= '<th width="10%">First Name</th>';
            $html .= '<th width="10%">Last Name</th>';
            $html .= '<th width="8%">DNI</th>';
            $html .= '<th width="15%">Email</th>';
            $html .= '<th width="10%">Phone</th>';
            $html .= '<th width="7%">Type</th>';
            $html .= '<th width="7%">Classes</th>';
            $html .= '<th width="7%">Machines</th>';
            $html .= '<th width="20%">Class List</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            
            foreach ($employees as $e) {
                $type_display = ($e['type_user'] == 'admin') ? 'ADMIN' : 'Employee';
                $type_class = ($e['type_user'] == 'admin') ? 'admin' : 'employee';
                $class_list = $e['class_list'] ?? 'None';
                if (strlen($class_list) > 30) {
                    $class_list = substr($class_list, 0, 30) . '...';
                }
                
                $html .= '<tr>';
                $html .= '<td align="center">' . $e['id_user'] . '</td>';
                $html .= '<td>' . htmlspecialchars($e['user_name'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td>' . htmlspecialchars($e['user_lastname'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td>' . htmlspecialchars($e['user_dni'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td>' . htmlspecialchars($e['user_email'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td>' . htmlspecialchars($e['user_phone'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td align="center"><span class="' . $type_class . '">' . $type_display . '</span></td>';
                $html .= '<td align="center">' . ($e['total_classes'] ?? 0) . '</td>';
                $html .= '<td align="center">' . ($e['total_machines_assigned'] ?? 0) . '</td>';
                $html .= '<td>' . htmlspecialchars($class_list, ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '</tr>';
            }
            
            $html .= '</tbody>';
            $html .= '</table>';
            
            // 5. WRITE HTML AND DOWNLOAD
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('mus_culito_employees_' . date('Y-m-d') . '.pdf', 'D');
            exit;
            
        } catch (\Exception $e) {
            error_log("Error in pdf_employees: " . $e->getMessage());
            echo "Error generating PDF: " . $e->getMessage();
            exit;
        }
    }

    /**
     * ========================================
     * SECTION 3: MACHINES (with employee assignment)
     * ========================================
     */
    public function pdf_machines() {
        try {
            // 1. GET DATA - ALL MACHINES WITH EMPLOYEE INFO
            $sql = "
                SELECT 
                    m.id_machine,
                    m.machine_name,
                    m.machine_status,
                    m.count_machine,
                    CONCAT(p.user_name, ' ', p.user_lastname) as assigned_employee,
                    p.user_dni as employee_dni,
                    p.user_email as employee_email,
                    p.user_phone as employee_phone,
                    u.type_user as employee_type
                FROM machines m
                LEFT JOIN \"user\" u ON m.id_employee = u.id_user
                LEFT JOIN people p ON u.id_people = p.id_people
                ORDER BY m.machine_name
            ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $machines = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // 2. CREATE PDF (Landscape)
            $pdf = new \TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            // IMPORTANT: Remove default headers/footers
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->setFontSubsetting(false);
            
            $pdf->SetCreator('El Mus-culito');
            $pdf->SetAuthor('Management System');
            $pdf->SetTitle('Machines Inventory');
            $pdf->SetMargins(10, 15, 10);
            $pdf->SetAutoPageBreak(TRUE, 15);
            $pdf->AddPage();
            
            // 3. HEADER
            $pdf->SetFont('helvetica', 'B', 20);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(0, 15, 'EL MUS-CULITO', 0, 1, 'C');
            
            $pdf->SetFont('helvetica', 'B', 16);
            $pdf->SetTextColor(223, 255, 0);
            $pdf->Cell(0, 10, 'MACHINES INVENTORY', 0, 1, 'C');
            
            $pdf->SetFont('helvetica', '', 11);
            $pdf->SetTextColor(100, 100, 100);
            $pdf->Cell(0, 8, 'Date: ' . date('d/m/Y H:i:s'), 0, 1, 'C');
            $pdf->Cell(0, 8, 'Total machines: ' . count($machines), 0, 1, 'C');
            $pdf->Ln(5);
            
            // 4. HTML TABLE - LANDSCAPE
            $html = '<style>
                        table {
                            border-collapse: collapse;
                            width: 100%;
                            font-family: helvetica;
                            font-size: 9px;
                        }
                        th {
                            background-color: #DFFF00;
                            color: black;
                            font-weight: bold;
                            padding: 6px;
                            text-align: center;
                            border: 1px solid #000000;
                        }
                        td {
                            padding: 4px;
                            border: 1px solid #000000;
                        }
                        tr:nth-child(even) {
                            background-color: #f2f2f2;
                        }
                        .operational {
                            color: #10b981;
                            font-weight: bold;
                        }
                        .not_operational {
                            color: #ef4444;
                            font-weight: bold;
                        }
                        .admin {
                            color: #DFFF00;
                            background-color: #000000;
                            padding: 1px 4px;
                            border-radius: 3px;
                        }
                    </style>';
            
            $html .= '<table cellpadding="4">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th width="5%">ID</th>';
            $html .= '<th width="15%">Machine Name</th>';
            $html .= '<th width="8%">Status</th>';
            $html .= '<th width="6%">Qty</th>';
            $html .= '<th width="18%">Assigned Employee</th>';
            $html .= '<th width="10%">Employee DNI</th>';
            $html .= '<th width="15%">Employee Email</th>';
            $html .= '<th width="12%">Employee Phone</th>';
            $html .= '<th width="6%">Type</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            
            foreach ($machines as $m) {
                $status = $m['machine_status'] ?? 'operational';
                $status_display = ($status == 'operational') ? 'OPERATIONAL' : 'NOT OPERATIONAL';
                $status_class = ($status == 'operational') ? 'operational' : 'not_operational';
                $employee = $m['assigned_employee'] ?? 'Not assigned';
                $employee_type = $m['employee_type'] ?? '';
                $type_display = ($employee_type == 'admin') ? 'Admin' : 'Employee';
                $type_class = ($employee_type == 'admin') ? 'admin' : '';
                
                $html .= '<tr>';
                $html .= '<td align="center">' . $m['id_machine'] . '</td>';
                $html .= '<td>' . htmlspecialchars($m['machine_name'] ?? '', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td align="center"><span class="' . $status_class . '">' . $status_display . '</span></td>';
                $html .= '<td align="center">' . ($m['count_machine'] ?? 0) . '</td>';
                $html .= '<td>' . htmlspecialchars($employee, ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td>' . htmlspecialchars($m['employee_dni'] ?? '-', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td>' . htmlspecialchars($m['employee_email'] ?? '-', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td>' . htmlspecialchars($m['employee_phone'] ?? '-', ENT_QUOTES, 'UTF-8') . '</td>';
                $html .= '<td align="center">';
                if ($employee != 'Not assigned') {
                    $html .= '<span class="' . $type_class . '">' . $type_display . '</span>';
                } else {
                    $html .= '-';
                }
                $html .= '</td>';
                $html .= '</tr>';
            }
            
            $html .= '</tbody>';
            $html .= '</table>';
            
            // 5. WRITE HTML AND DOWNLOAD
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('mus_culito_machines_' . date('Y-m-d') . '.pdf', 'D');
            exit;
            
        } catch (\Exception $e) {
            error_log("Error in pdf_machines: " . $e->getMessage());
            echo "Error generating PDF: " . $e->getMessage();
            exit;
        }
    }

    /**
     * ========================================
     * SECTION 4: COMPLETE REPORT (Executive Summary)
     * ========================================
     */
    public function pdf_complete() {
        try {
            $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            
            // IMPORTANT: Remove default headers/footers
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->setFontSubsetting(false);
            
            $pdf->SetCreator('El Mus-culito');
            $pdf->SetAuthor('Management System');
            $pdf->SetTitle('Complete Report');
            $pdf->SetMargins(15, 15, 15);
            $pdf->SetAutoPageBreak(TRUE, 15);
            
            // ===== PAGE 1: EXECUTIVE SUMMARY =====
            $pdf->AddPage();
            
            // Header
            $pdf->SetFont('helvetica', 'B', 24);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(0, 20, 'EL MUS-CULITO', 0, 1, 'C');
            
            $pdf->SetFont('helvetica', 'B', 18);
            $pdf->SetTextColor(223, 255, 0);
            $pdf->Cell(0, 12, 'EXECUTIVE SUMMARY', 0, 1, 'C');
            
            $pdf->SetFont('helvetica', '', 11);
            $pdf->SetTextColor(100, 100, 100);
            $pdf->Cell(0, 8, 'Date: ' . date('d/m/Y H:i:s'), 0, 1, 'C');
            $pdf->Ln(10);
            
            // 1. CLIENTS SUMMARY
            $sql_clients = "SELECT COUNT(*) as total FROM \"user\" WHERE type_user = 'user'";
            $stmt = $this->conn->prepare($sql_clients);
            $stmt->execute();
            $total_clients = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $sql_active = "
                SELECT COUNT(DISTINCT u.id_user) as total
                FROM \"user\" u
                JOIN membership m ON m.id_user = u.id_user
                WHERE u.type_user = 'user' AND m.end_date >= CURRENT_DATE
            ";
            $stmt = $this->conn->prepare($sql_active);
            $stmt->execute();
            $active_clients = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetTextColor(223, 255, 0);
            $pdf->Cell(0, 10, '1. CLIENTS OVERVIEW', 0, 1, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->Cell(0, 7, 'Total clients: ' . $total_clients, 0, 1, 'L');
            $pdf->Cell(0, 7, 'Active memberships: ' . $active_clients, 0, 1, 'L');
            $pdf->Cell(0, 7, 'Inactive clients: ' . ($total_clients - $active_clients), 0, 1, 'L');
            $pdf->Ln(5);
            
            // 2. EMPLOYEES SUMMARY
            $sql_employees = "SELECT COUNT(*) as total FROM \"user\" WHERE type_user IN ('employee', 'admin')";
            $stmt = $this->conn->prepare($sql_employees);
            $stmt->execute();
            $total_employees = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $sql_admins = "SELECT COUNT(*) as total FROM \"user\" WHERE type_user = 'admin'";
            $stmt = $this->conn->prepare($sql_admins);
            $stmt->execute();
            $total_admins = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $sql_instructors = "SELECT COUNT(*) as total FROM \"user\" WHERE type_user = 'employee'";
            $stmt = $this->conn->prepare($sql_instructors);
            $stmt->execute();
            $total_instructors = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetTextColor(223, 255, 0);
            $pdf->Cell(0, 10, '2. EMPLOYEES OVERVIEW', 0, 1, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->Cell(0, 7, 'Total employees: ' . $total_employees, 0, 1, 'L');
            $pdf->Cell(0, 7, 'Administrators: ' . $total_admins, 0, 1, 'L');
            $pdf->Cell(0, 7, 'Instructors: ' . $total_instructors, 0, 1, 'L');
            $pdf->Ln(5);
            
            // 3. MACHINES SUMMARY
            $sql_machines = "SELECT COUNT(*) as total FROM machines";
            $stmt = $this->conn->prepare($sql_machines);
            $stmt->execute();
            $total_machines = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $sql_operational = "SELECT COUNT(*) as total FROM machines WHERE machine_status = 'operational'";
            $stmt = $this->conn->prepare($sql_operational);
            $stmt->execute();
            $operational = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $sql_assigned = "SELECT COUNT(*) as total FROM machines WHERE id_employee IS NOT NULL";
            $stmt = $this->conn->prepare($sql_assigned);
            $stmt->execute();
            $assigned = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetTextColor(223, 255, 0);
            $pdf->Cell(0, 10, '3. MACHINES OVERVIEW', 0, 1, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->Cell(0, 7, 'Total machines: ' . $total_machines, 0, 1, 'L');
            $pdf->Cell(0, 7, 'Operational: ' . $operational, 0, 1, 'L');
            $pdf->Cell(0, 7, 'Not operational: ' . ($total_machines - $operational), 0, 1, 'L');
            $pdf->Cell(0, 7, 'Assigned to employees: ' . $assigned, 0, 1, 'L');
            $pdf->Cell(0, 7, 'Unassigned: ' . ($total_machines - $assigned), 0, 1, 'L');
            $pdf->Ln(5);
            
            // 4. CLASSES SUMMARY
            $sql_classes = "SELECT COUNT(*) as total FROM class";
            $stmt = $this->conn->prepare($sql_classes);
            $stmt->execute();
            $total_classes = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $sql_schedules = "SELECT COUNT(*) as total FROM class_schedule";
            $stmt = $this->conn->prepare($sql_schedules);
            $stmt->execute();
            $total_schedules = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetTextColor(223, 255, 0);
            $pdf->Cell(0, 10, '4. CLASSES OVERVIEW', 0, 1, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->Cell(0, 7, 'Total classes: ' . $total_classes, 0, 1, 'L');
            $pdf->Cell(0, 7, 'Total schedules: ' . $total_schedules, 0, 1, 'L');
            $pdf->Ln(5);
            
            // 5. FINANCIAL SUMMARY
            $sql_revenue = "
                SELECT 
                    COUNT(*) as total_payments,
                    COALESCE(SUM(amount), 0) as total_revenue,
                    COALESCE(AVG(amount), 0) as average_payment
                FROM payments
                WHERE EXTRACT(MONTH FROM payment_date) = EXTRACT(MONTH FROM CURRENT_DATE)
                AND EXTRACT(YEAR FROM payment_date) = EXTRACT(YEAR FROM CURRENT_DATE)
            ";
            $stmt = $this->conn->prepare($sql_revenue);
            $stmt->execute();
            $finance = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $pdf->SetFont('helvetica', 'B', 14);
            $pdf->SetTextColor(223, 255, 0);
            $pdf->Cell(0, 10, '5. FINANCIAL OVERVIEW', 0, 1, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->Cell(0, 7, 'Monthly payments: ' . ($finance['total_payments'] ?? 0), 0, 1, 'L');
            $pdf->Cell(0, 7, 'Monthly revenue: $' . number_format($finance['total_revenue'] ?? 0, 2), 0, 1, 'L');
            $pdf->Cell(0, 7, 'Average payment: $' . number_format($finance['average_payment'] ?? 0, 2), 0, 1, 'L');
            
            // 4. OUTPUT
            $pdf->Output('mus_culito_complete_report_' . date('Y-m-d') . '.pdf', 'D');
            exit;
            
        } catch (\Exception $e) {
            error_log("Error in pdf_complete: " . $e->getMessage());
            echo "Error generating PDF: " . $e->getMessage();
            exit;
        }
    }
}
?>