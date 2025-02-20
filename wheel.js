const harvestValue = localStorage.getItem("harvestValue");
const toHarvest = document.querySelector(".bMNWii.css-vurnku");
const wheelDiv = document.querySelector(".wheelDiv");
const wheel = document.querySelector(".wheel");
const startButton = document.getElementById("wheel-spin-button");
const claimButton = document.getElementById("wheel-claim-button");
const popupContainer = document.querySelector(".popup-container");

function spinWheel() {
  (function () {
    wheelDiv.display = "block";
    let deg = 0;

    startButton.addEventListener("click", () => {
      deg = Math.floor(2000 + Math.random() * 2000);
      wheel.style.transition = "all 5s ease-out";
      wheel.style.transform = `rotate(${deg}deg)`;
      wheel.classList.add("blur");
      startButton.style.pointerEvents = "none";
    });

    wheel.addEventListener("transitionend", () => {
      wheel.classList.remove("blur");
      wheel.style.transition = "none";
      const actualDeg = deg % 360;
      wheel.style.transform = `rotate(${actualDeg}deg)`;
      startButton.style.display = "none";
      const result = getResult(actualDeg);
      claimReward(result);
      claimButton.style.display = "block";
    });

    function claimReward(result) {
      claimButton.addEventListener("click", () => {
        localStorage.setItem("harvestValue", result);
        toHarvest.textContent = result;
        wheelDiv.style.display = "none";
      });
    }

    function getResult(deg) {
      const segmentAngle = 360 / 12;
      const offsetAngle = segmentAngle / 2;
      const normalizedDeg = deg < 0 ? 360 + (deg % 360) : deg;
      const adjustedDeg = normalizedDeg + offsetAngle;
      const resultIndex = Math.floor(adjustedDeg / segmentAngle) % 12;
      const totalResults = 12;
      const results = [
        "111",
        "144",
        "376",
        "255",
        "189",
        "666",
        "33",
        "999",
        "333",
        "66",
        "411",
        "0",
      ];

      const result = results[(totalResults - resultIndex) % totalResults];
      return result;
    }
  })();
}

if (harvestValue) {
  wheelDiv.style.display = "none";
  toHarvest.textContent = harvestValue;
} else {
  spinWheel();
  popupContainer.style.display = "block";
}
