import refreshItemList from "./refreshItemList";
export default async function mergeItems(itemContainer: HTMLElement) {
  const itemsToMerge = itemContainer.children;
  const itemSlugs = Array.from(itemsToMerge).map(
    // @ts-ignore
    (item) => item.dataset.itemSlug
  );

  console.log(itemSlugs);

  try {
    const response = await fetch(
      window.location.href + "library/fetch/endpoint.php?action=merge_items",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(itemSlugs),
      }
    );

    if (!response.ok) console.error(`HTTP error! status: ${response.status}`);

    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Failed to merge items:", error);
    return false;
  }
}
