import getAllItems from "./getAllItems";
import createItemEl from "./createItemEl";
import selectItem from "./selectItem";

export default async function refreshItemList(
  itemList: HTMLElement,
  itemContainer: HTMLElement
): Promise<void> {
  if (!itemList) {
    console.error("Missing required elements");
    return;
  }

  itemList.style.opacity = "0.5";
  itemContainer.style.opacity = "0.5";

  const itemData = await getAllItems();

  itemList.innerHTML = "";

  itemData.forEach((item) => {
    // @ts-ignore
    if (!item.unlocked) return;
    const newEl = createItemEl(
      {
        // @ts-ignore
        slug: item.slug,
        // @ts-ignore
        emoji: item.emoji,
        // @ts-ignore
        name: item.name,
      },
      itemList
    );

    newEl.addEventListener("click", (e) => {
      const target = e.target as HTMLElement;

      if (!target.closest("#item-list")) {
        return;
      }

      const newEl = createItemEl(
        {
          slug: target.getAttribute("data-item-slug"),
          emoji: target.getAttribute("data-item-emoji"),
          name: target.getAttribute("data-item-name"),
        },
        itemContainer
      );

      newEl.addEventListener("click", (e) => {
        const itemEl = e.target as HTMLElement;
        if (!itemEl) return;

        selectItem(itemEl, itemList, itemContainer);
      });
    });
  });

  itemList.style.opacity = "1";
  itemContainer.style.opacity = "1";
}
