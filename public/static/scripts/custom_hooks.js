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
    localStorage.setItem(key, JSON.stringify(value));
  } else {
    const data = localStorage.getItem(key);
    return data ? JSON.parse(data) : false;
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

export { useFetch, useToken, useStorage };
