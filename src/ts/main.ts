import "../scss/style.scss";
import "./../../node_modules/bootstrap/dist/css/bootstrap.min.css";

import refreshItemList from "./modules/refreshItemList";

document.addEventListener("DOMContentLoaded", () => {
  //@ts-ignore
  const itemList: HTMLElement = document.querySelector("#item-list");
  //@ts-ignore
  const itemContainer: HTMLElement = document.querySelector("#item-container");

  if (!itemList) {
    console.error("Missing required elements");
    return;
  }

  async function init() {
    refreshItemList(itemList, itemContainer);
  }

  init();
});
