// LOADING
let selected = "";

// action
export const setBtnAction = {
  name: (selector = ".form_btn") => (selected = selector),
  loading: () => $(selected).addClass("process"),
  done: () => setTimeout(() => $(selected).removeClass("process"), 800),
};
