document.getElementById("loginForm").addEventListener("submit", async (e) => {
  e.preventDefault();

  const formData = new FormData(e.target);

  try {
    const response = await fetch("http://localhost/el_mus_culito/sing_up", {
      method: "POST",
      body: formData,
    });

    await response.json().then((message) => {
      if (message.status === "error") {
        showAlert(message.message, message.status);
      } else if (message.status === "success") {
        showAlert(message.message, message.status);
        setTimeout(() => {
          window.location.href = message.location;
        }, 2000);
      }
    });
  } catch (err) {
    return err;
  }
});

function showAlert(message, type) {
  const container = document.getElementById("alert-container");
  const alert = document.createElement("div");
  alert.className = `alert-custom alert-${type}`;
  alert.innerHTML = `<p style color >${message}</p>`;
  container.appendChild(alert);

  setTimeout(() => {
    alert.style.opacity = "0";
    setTimeout(() => alert.remove(), 500);
  }, 4000);
}
