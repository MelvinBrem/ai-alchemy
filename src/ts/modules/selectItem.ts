import mergeItems from "./mergeItems";
import refreshItemList from "./refreshItemList";
import createItemEl from "./createItemEl";

export default function selectItem(
  itemEl: HTMLElement,
  itemList: HTMLElement,
  itemContainer: HTMLElement
) {
  itemEl.classList.toggle("selected");

  const selectedItems = itemContainer.querySelectorAll(
    ".selected"
  ) as NodeListOf<HTMLElement>;

  if (selectedItems.length === 2) {
    const itemA: string = selectedItems[0].getAttribute("data-item-slug") ?? "";
    const itemB: string = selectedItems[1].getAttribute("data-item-slug") ?? "";

    if (itemA === "" || itemB === "") {
      console.error("Missing required data attributes");
      return false;
    }

    mergeItems(itemA, itemB).then((mergedItem) => {
      if (mergedItem == false) {
        itemContainer.querySelectorAll(".selected").forEach((item) => {
          item.classList.remove("selected");
          return false;
        });
      }

      selectedItems.forEach((item) => {
        itemContainer.removeChild(item);
      });

      const newEl = createItemEl(
        {
          // @ts-ignore
          slug: mergedItem.slug,
          // @ts-ignore
          emoji: mergedItem.emoji,
          // @ts-ignore
          name: mergedItem.name,
        },
        itemContainer
      );

      newEl.addEventListener("click", (e) => {
        const itemEl = e.target as HTMLElement;
        if (!itemEl) return;

        selectItem(itemEl, itemList, itemContainer);
      });
    });

    refreshItemList(itemList, itemContainer);
  }
}
