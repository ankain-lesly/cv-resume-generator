async function makeFetch(method, url, data) {
  console.log("Request..");
  const return_data = {};

  const config = {
    method: method,
    headers: {
      // "Accept": "application/json",
      Accept: "*",
      // "Content-Type": "application/json",
    },
  };

  if (method.toUpperCase() !== "GET") config.body = JSON.stringify(data);

  const res = await fetch(url, config).catch((err) => {
    console.log(err);
    // console.log(err.response.data);
  });
  return_data.data = await res.json();
  const response = { ok: res.ok, status: res.status };

  return_data.response = response;
  return return_data;
}

export default {
  makeFetch,
};
