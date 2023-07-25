import { token_id } from "./config.js";
// Set and Get user
const useToken = (value = "") => {
  if (value) {
    useStorage(token_id, value);
  } else {
    return useStorage(token_id);
  }
};
// Set and Get user
const useStorage = (key, value) => {
  if (value) {
    localStorage.setItem(key, value);
  } else {
    return localStorage.getItem(key);
  }
};

// Custom Fetch
const useFetch = async (method, url, data) => {
  try {
    const return_data = {};
    const config = {
      method: method,
      headers: {
        // "Accept": "application/json",
        Accept: "*",
        // "Content-Type": "application/json",
        // Authorization: "Bearer xyz",
      },
    };

    if (method.toUpperCase() !== "GET") {
      config.body = JSON.stringify(data);
    }

    const res = await fetch(url, config).catch((err) => {
      console.log(err);
      // console.log(err.response.data);
    });
    return_data.data = await res.json();

    const response = { ok: res.ok, status: res.status };

    return_data.response = response;
    return return_data;
  } catch (err) {
    console.log(err);
  }
};

// Toasts
const useToast = (message) => {
  let toast = `
    <div class="Toastify_me_dev">
      <div class="toast_box flex between gap-x">
        <span class="toast_icon fas fa-bell"></span>
        <div class="toast_text flex-1">
          <p>${message}</p>
        </div>
        <span class="toast_close_btn">&times;</span>
      </div>
    </div>`;

  $(".Toast_container").html(toast);
  console.log("Toasting");
};
// module.exports = {
//   makeFetch,
// };
export { useFetch, useToken, useStorage, useToast };
