import refreshItemList from "./refreshItemList";

export default async function mergeItems(
  itemA: String,
  itemB: String
): Promise<string | false> {
  try {
    const response = await fetch(
      window.location.href + "library/fetch/endpoint.php?action=merge_items",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify([itemA, itemB]),
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
