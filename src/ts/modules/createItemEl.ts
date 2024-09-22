export default function createItemEl(
  item: object,
  parent: HTMLElement
): HTMLElement {
  let itemEl = document.createElement("div");
  // @ts-ignore
  itemEl.setAttribute("data-item-slug", item.slug);
  // @ts-ignore
  itemEl.setAttribute("data-item-name", item.name);
  // @ts-ignore
  itemEl.innerText = item.name;
  itemEl.classList.add("item");

  parent.appendChild(itemEl);
  return itemEl;
}
