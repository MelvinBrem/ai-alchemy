import "../scss/style.scss";
import "./../../node_modules/bootstrap/dist/css/bootstrap.min.css";

import refreshItemList from "./modules/refreshItemList";
import mergeItems from "./modules/mergeItems";

document.addEventListener("DOMContentLoaded", () => {
  //@ts-ignore
  const itemList: HTMLElement = document.querySelector("#item-list");
  //@ts-ignore
  const itemContainer: HTMLElement = document.querySelector("#item-container");
  //@ts-ignore
  const itemButton: HTMLElement = document.querySelector("#item-button");

  if (!itemList || !itemContainer || !itemButton) {
    console.error("Missing required elements");
    return;
  }

  async function init() {
    refreshItemList(itemList, itemContainer);

    itemButton.addEventListener("click", async () => {
      let newItem = await mergeItems(itemContainer);
      itemContainer.innerHTML = "";
      refreshItemList(itemList, itemContainer);
    });
  }

  init();
});
