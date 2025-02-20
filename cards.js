function createCard(cardData) {
  const cardContainer = document.createElement("div");
  cardContainer.classList.add("card");

  const starBackground = document.createElement("div");
  starBackground.classList.add("star-background");

  const starImg = document.createElement("img");
  starImg.src = "https://www.bakeryswap.org/images/bakery/icon_star.svg";
  starImg.classList.add("star");

  starBackground.appendChild(starImg);
  cardContainer.appendChild(starBackground);

  const tokenImage = document.createElement("div");
  tokenImage.classList.add("token-image");

  const tokenImg = document.createElement("img");
  tokenImg.src = cardData.imageSrc;
  tokenImg.style.height = "54px";
  tokenImg.style.marginBottom = "0px";
  tokenImg.style.marginTop = "0px";

  tokenImage.appendChild(tokenImg);
  cardContainer.appendChild(tokenImage);

  const tokenTitle = document.createElement("div");
  tokenTitle.classList.add("token-title");

  const titleDiv = document.createElement("div");
  titleDiv.classList.add("css-2tt9xh");
  titleDiv.textContent = cardData.title;

  tokenTitle.appendChild(titleDiv);
  cardContainer.appendChild(tokenTitle);

  const depositDescription = createDescription("Deposit:", cardData.deposit);
  cardContainer.appendChild(depositDescription);

  const earnDescription = createDescription("Earn:", cardData.earn);
  cardContainer.appendChild(earnDescription);

  const roiDescription = createDescription("ROI:", cardData.roi);
  cardContainer.appendChild(roiDescription);

  const tokenButton = document.createElement("div");
  tokenButton.classList.add("token-button");

  const link = document.createElement("a");
  link.href = cardData.link;
  link.textContent = "Select";

  tokenButton.appendChild(link);
  cardContainer.appendChild(tokenButton);

  return cardContainer;
}

function createDescription(label, value) {
  const descriptionContainer = document.createElement("div");
  descriptionContainer.classList.add("token-description");

  const labelDiv = document.createElement("div");
  labelDiv.classList.add("css-vurnku");
  labelDiv.textContent = label;

  const valueContainer = document.createElement("div");
  valueContainer.classList.add("token-desc-secondary");

  const valueDiv = document.createElement("div");
  valueDiv.classList.add("css-o8yhuq");
  valueDiv.textContent = value;

  valueContainer.appendChild(valueDiv);
  descriptionContainer.appendChild(labelDiv);
  descriptionContainer.appendChild(valueContainer);

  return descriptionContainer;
}

const cardContainer = document.querySelector(".cards-container");

cardDataArray.forEach((cardData) => {
  const cardElement = createCard(cardData);
  cardContainer.appendChild(cardElement);
});
