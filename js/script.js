// Header, jika discroll memunculkan bayangan
window.onscroll = () => {
  const header = document.querySelector("#header");
  if (this.scrollY >= 20) {
    header.classList.add("scroller");
  } else {
    header.classList.remove("scroller");
  }
};

// Toggle Menu
document.querySelector("#toggle").onclick = () =>
  document.querySelector("#nav-links").classList.toggle("active");

// Auto-Slide Mobil
window.onload = () => {
  const Colors = document.querySelectorAll("#types .list");
  const Cars = document.querySelectorAll("#cars .list");
  let currentCar = 0;
  let currentColor = 0;

  function showCar(index) {
    Cars.forEach((car, i) => {
      car.classList.remove("active");
      if (i === index) car.classList.add("active");
    });
  }

  function showColor(index) {
    Colors.forEach((color, i) => {
      color.classList.remove("active");
      if (i === index) color.classList.add("active");
    });
  }

  function nextCar() {
    currentCar = (currentCar + 1) % Cars.length;
    currentColor = (currentColor + 1) % Colors.length;
    showCar(currentCar);
    showColor(currentColor);
  }

  setInterval(nextCar, 3000);
};

// Kirim email (Newsletter)
document.querySelector("#newsletter").onsubmit = (event) => {
  event.preventDefault();
  const email = document.querySelector("#email").value;

  if (email) {
    alert(`Thank you ${email}, for reaching out to us!`);
  } else {
    alert("Please enter a vaild email");
  }
};
