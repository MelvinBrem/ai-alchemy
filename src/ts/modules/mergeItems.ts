import refreshItemList from "./refreshItemList";

export default async function mergeItems(
  items: NodeListOf<HTMLElement>
): Promise<string | false> {
  const itemSlugs = Array.from(items).map(
    // @ts-ignore
    (item) => item.dataset.itemSlug
  );

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

    if (!response.ok) {
      console.error(`HTTP error! status: ${response.status}`);
      return false;
    }

    const itemData = await response.json();
    return itemData;
  } catch (error) {
    console.error("Failed to merge items:", error);
    return false;
  }
}
