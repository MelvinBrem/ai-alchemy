import getAllItems from "./getAllItems";
import createItemEl from "./createItemEl";
import mergeItems from "./mergeItems";

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
          name: target.getAttribute("data-item-name"),
        },
        itemContainer
      );

      newEl.addEventListener("click", (e) => {
        e.preventDefault();
        newEl.classList.toggle("selected");

        const selectedItems = itemContainer.querySelectorAll(
          ".selected"
        ) as NodeListOf<HTMLElement>;

        if (selectedItems.length === 2) {
          mergeItems(selectedItems).then((mergedItem) => {
            if (false === mergedItem) {
              itemContainer.querySelectorAll(".selected").forEach((item) => {
                item.classList.remove("selected");
              });
            }

            selectedItems.forEach((item) => {
              itemContainer.removeChild(item);
            });

            createItemEl(
              {
                // @ts-ignore
                slug: mergedItem.slug,
                // @ts-ignore
                name: mergedItem.name,
              },
              itemContainer
            );
          });
          refreshItemList(itemList, itemContainer);
        }
      });
    });
  });

  itemList.style.opacity = "1";
  itemContainer.style.opacity = "1";
}
