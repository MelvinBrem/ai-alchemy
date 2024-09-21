import refreshItemList from "./refreshItemList";

export default async function mergeItems(itemContainer: HTMLElement) {
  const itemsToMerge = itemContainer.children;
  const itemSlugs = Array.from(itemsToMerge).map(
    (item) => item.dataset.itemSlug
  );

  try {
    const response = await fetch(
      window.location.href + "library/ajax/mergeItems.php",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(itemSlugs),
      }
    );
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Failed to merge items:", error);
    return false;
  }
}
