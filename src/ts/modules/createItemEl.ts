export default function createItemEl(item: object, parent: HTMLElement): void {
  let itemEl = document.createElement("div");
  itemEl.setAttribute("data-item-slug", item.slug);
  itemEl.setAttribute("data-item-name", item.name);
  // @ts-ignore
  itemEl.innerText = item.name;
  itemEl.classList.add("item");

  parent.appendChild(itemEl);
}
