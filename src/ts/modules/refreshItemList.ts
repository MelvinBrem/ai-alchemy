import getItems from "./getItems";
import createItemEl from "./createItemEl";

export default async function refreshItemList(
  itemList: HTMLElement,
  itemContainer: HTMLElement
): Promise<void> {
  if (!itemList || !itemContainer) {
    console.error("Missing required elements");
    return;
  }

  itemList.style.opacity = "0.2";

  const itemData = await getItems();

  itemList.innerHTML = "";

  itemData.forEach((item) => {
    // @ts-ignore
    if (!item.initial) return;
    createItemEl(
      {
        slug: item.slug,
        name: item.name,
      },
      itemList
    );
  });

  itemList.style.opacity = "1";

  document.addEventListener("click", (e) => {
    const target = e.target as HTMLElement;

    if (!target.classList.contains("item") || !target.closest("#item-list")) {
      return;
    }

    const itemSlug = target.dataset.itemSlug;
    const itemName = target.dataset.itemName;

    if (
      itemContainer.querySelector(`[data-item-slug="${itemSlug}"]`) ||
      itemContainer.children.length >= 2
    ) {
      return;
    }

    createItemEl({ slug: itemSlug, name: itemName }, itemContainer);
  });
}
