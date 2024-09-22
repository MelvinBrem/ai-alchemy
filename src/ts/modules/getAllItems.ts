export default async function getAllItems(): Promise<Array<object>> {
  try {
    const response = await fetch(
      window.location.href + "library/fetch/endpoint.php?action=get_all_items",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
      }
    );
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
