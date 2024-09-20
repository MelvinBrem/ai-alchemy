import Groq from "groq-sdk";

import "./../scss/style.scss";
import "./../../node_modules/bootstrap/dist/css/bootstrap.min.css";

const groq = new Groq({
  apiKey: import.meta.env.VITE_GROQ_API_KEY,
  dangerouslyAllowBrowser: true,
});

document.addEventListener("DOMContentLoaded", () => {
  //@ts-ignore
  const input: HTMLInputElement = document.querySelector("#input");
  //@ts-ignore
  const output: HTMLTextAreaElement = document.querySelector("#output");
  if (!input || !output) return;

  input.addEventListener("keydown", function (e) {
    if (e.code === "Enter") {
      // output.value += submitPrompt(input.value) + "\n";
      submitPrompt(input.value).then((response) => {
        output.value += response + "\n";
      });
    }
  });

  async function submitPrompt(inputValue: string): Promise<string> {
    input.style.backgroundColor = "gray";
    const chatCompletion = await getGroqChatCompletion(inputValue);
    input.style.backgroundColor = "initial";
    return chatCompletion.choices[0]?.message?.content || "";
  }

  async function getGroqChatCompletion(inputValue: string) {
    return groq.chat.completions.create({
      messages: [
        {
          role: "user",
          content: inputValue,
        },
      ],
      model: "llama3-8b-8192",
    });
  }
});
