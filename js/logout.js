const logoutBtn = document.querySelector(".logout");

logoutBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/logout.php", true); // Заявката към logout.php
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let response = xhr.responseText.trim();
        console.log("📩 Logout Response:", response); // Дебъг съобщение
        if (response === "success") {
          // Ако logout е успешен, пренасочваме към login.php
          window.location.href = "/RealTime Chat App/login.php";
        } else {
          // Ако нещо се обърка, показваме съобщение за грешка
          alert("Logout failed: " + response);
        }
      }
    }
  };
  xhr.send();
};
