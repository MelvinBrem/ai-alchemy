import Groq from "groq-sdk";

import "../scss/style.scss";
import "./../../node_modules/bootstrap/dist/css/bootstrap.min.css";
import getItems from "./modules/Items";
import getCombinations from "./modules/Combinations";

const groq = new Groq({
  apiKey: import.meta.env.VITE_GROQ_API_KEY,
  dangerouslyAllowBrowser: true,
});

document.addEventListener("DOMContentLoaded", () => {
  //@ts-ignore
  const itemList: HTMLElement = document.querySelector("#item-list");
  //@ts-ignore
  const itemContainer: HTMLElement = document.querySelector("#item-container");
  //@ts-ignore
  const itemTemplate: HTMLElement = document.querySelector("#item-template");

  if (!itemList || !itemContainer || !itemTemplate) {
    console.error("Missing required elements");
    return;
  }

  const ajaxUrl = `${window.location.href}library/ajax`;

  async function init() {
    const items = await getItems(ajaxUrl, true);
    const combinations = await getCombinations(ajaxUrl);

    items.forEach((item) => {
      if (!item.initial) return;
      let itemEl = document.createElement("div");
      itemEl.classList.add("item");
      itemEl.innerText = item.name;

      itemList.appendChild(itemEl);
    });

    combinations.forEach((element: Combination) => {
      // console.log(element);
    });
  }

  init();
});
