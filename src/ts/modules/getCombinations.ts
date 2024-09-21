export default async function getCombinations(): Promise<Array<object>> {
  try {
    const response = await fetch(
      window.location.href + "library/ajax/getItems.php",
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
    console.error("Failed to fetch combinations:", error);
    return [];
  }
}
