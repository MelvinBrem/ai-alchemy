/**
 * Creates a new HTML element representing an item and appends it to the specified parent element.
 *
 * @param item - An object representing the item. The object should have the following properties:
 *   @property {string} emoji - An emoji representing the item.
 *   @property {string} slug - A unique identifier for the item.
 *   @property {string} name - The name of the item.
 * @param parent - The parent HTML element to which the new item element will be appended.
 * @returns The newly created HTML element representing the item.
 */
export default function createItemEl(
  item: object,
  parent: HTMLElement
): HTMLElement {
  let itemEl = document.createElement("div");
  // @ts-ignore
  itemEl.setAttribute("data-item-slug", item.slug);
  // @ts-ignore
  itemEl.setAttribute("data-item-emoji", item.emoji);
  // @ts-ignore
  itemEl.setAttribute("data-item-name", item.name);

  // @ts-ignore
  itemEl.innerText = item.emoji + " " + item.name;
  itemEl.classList.add("item");

  parent.appendChild(itemEl);
  return itemEl;
}
