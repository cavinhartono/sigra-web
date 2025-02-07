const score = document.querySelector(".score");
const startScreen = document.querySelector(".startScreen");
const gameArea = document.querySelector(".gameArea");

document.addEventListener("keydown", keyDown);
document.addEventListener("keyup", keyUp);

let player = {
  speed: 5,
  level: 1,
  levelThreshold: 500, // Skor untuk naik level
  levelMultiplier: 1.2, // Faktor peningkatan kecepatan tiap level
  enemySpeed: 3, // Kecepatan awal musuh
};

startScreen.addEventListener("click", startGame);

let keys = {
  ArrowUp: false,
  ArrowDown: false,
  ArrowLeft: false,
  ArrowRight: false,
};

function keyDown(e) {
  e.preventDefault();
  keys[e.key] = true;
}

function keyUp(e) {
  e.preventDefault();
  keys[e.key] = false;
}

function gamePlay() {
  let car = document.querySelector(".car");
  let road = gameArea.getBoundingClientRect();

  if (player.start) {
    moveLines();
    moveEnemyCar(car);

    if (keys.ArrowUp && player.y > road.top + 150) {
      player.y -= player.speed;
    }
    if (keys.ArrowDown && player.y < road.bottom - 80) {
      player.y += player.speed;
    }
    if (keys.ArrowLeft && player.x > 0) {
      player.x -= player.speed;
    }
    if (keys.ArrowRight && player.x < road.width - 70) {
      player.x += player.speed;
    }

    car.style.top = `${player.y}px`;
    car.style.left = `${player.x}px`;

    player.score++;

    // Periksa apakah level naik
    if (player.score >= player.level * player.levelThreshold) {
      player.level++;
      player.speed *= player.levelMultiplier; // Tingkatkan kecepatan pemain
      player.enemySpeed *= player.levelMultiplier; // Tingkatkan kecepatan musuh
    }

    score.innerHTML = `Score: ${player.score}`;

    window.requestAnimationFrame(gamePlay);
  }
}

function moveLines() {
  let lines = document.querySelectorAll(".line");
  lines.forEach((line) => {
    if (line.y >= 700) {
      line.y -= 750;
    }
    line.y += player.speed;
    line.style.top = line.y + "px";
  });
}

function isCollide(car, enemyCar) {
  let carRect = car.getBoundingClientRect();
  let enemyCarRect = enemyCar.getBoundingClientRect();

  return !(
    carRect.top > enemyCarRect.bottom ||
    carRect.left > enemyCarRect.right ||
    carRect.right < enemyCarRect.left ||
    carRect.bottom < enemyCarRect.top
  );
}

function moveEnemyCar(car) {
  let enemyCars = document.querySelectorAll(".enemyCar");
  enemyCars.forEach((enemyCar) => {
    if (isCollide(car, enemyCar)) {
      endGame();
    }

    if (enemyCar.y >= 750) {
      enemyCar.y = -300;
      enemyCar.style.left = Math.floor(Math.random() * 350) + "px";
    }
    enemyCar.y += player.enemySpeed; // Gunakan kecepatan musuh yang meningkat
    enemyCar.style.top = enemyCar.y + "px";
  });
}

function startGame() {
  score.classList.remove("hide");
  startScreen.classList.add("hide");
  gameArea.innerHTML = "";

  player.start = true;
  player.score = 0;
  player.level = 1;
  player.speed = 5;
  player.enemySpeed = 3;

  window.requestAnimationFrame(gamePlay);

  for (let i = 0; i < 5; i++) {
    let roadLine = document.createElement("div");
    roadLine.setAttribute("class", "line");
    roadLine.y = i * 150;
    roadLine.style.top = roadLine.y + "px";
    gameArea.appendChild(roadLine);
  }

  let car = document.createElement("div");
  car.setAttribute("class", "car");

  gameArea.appendChild(car);

  player.x = car.offsetLeft;
  player.y = car.offsetTop;

  for (let i = 0; i < 3; i++) {
    let enemyCar = document.createElement("div");
    enemyCar.setAttribute("class", "enemyCar");
    enemyCar.y = (i + 1) * 350 * -1;
    enemyCar.style.top = enemyCar.y + "px";
    enemyCar.style.backgroundImage = `url("../img/test_drive/car${i + 1}.png")`;
    enemyCar.style.left = Math.floor(Math.random() * 350) + "px";
    gameArea.appendChild(enemyCar);
  }
}

function endGame() {
  player.start = false;
  startScreen.classList.remove("hide");
}
