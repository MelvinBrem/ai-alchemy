export default async function getItems(
  ajaxUrl: string
): Promise<Array<object>> {
  try {
    const response = await fetch(ajaxUrl + "/getItems.php", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    return data;
  } catch (error) {
    console.error("Failed to fetch items:", error);
    return [];
  }
}
