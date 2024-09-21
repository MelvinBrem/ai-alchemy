import Groq from "groq-sdk";

import "../scss/style.scss";
import "./../../node_modules/bootstrap/dist/css/bootstrap.min.css";

const groq = new Groq({
  apiKey: import.meta.env.VITE_GROQ_API_KEY,
  dangerouslyAllowBrowser: true,
});

document.addEventListener("DOMContentLoaded", () => {
  //@ts-ignore
  const test: HTMLTextAreaElement = document.querySelector("#test");
  const url = `${window.location.href}/library/ajax`;

  fetch(url + "/getItems.php", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
    });
  test.value = "Hello World!";
});
