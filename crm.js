function getFieldError(el) {
  const validity = el.validity;

  if (validity.valid) return true;

  if (validity.valueMissing) return "Wypełnij pole";

  if (validity.typeMismatch) {
    if (el.type === "email") return "Wpisz poprawny email";
    if (el.type === "url") return "Wpisz poprawny adres URL";
  }
  if (validity.patternMismatch) return "Wpisana wartość nie spełnia wymagań";

  return "Wypełnij poprawnie pole";
}

function removeFieldError(field) {
  const errorField = field.nextElementSibling;
  if (errorField !== null) {
    if (errorField.classList.contains("form-error-text")) {
      errorField.remove();
    }
  }
}

function createFieldError(field, text) {
  removeFieldError(field);

  const div = document.createElement("div");
  div.classList.add("form-error-text");
  div.innerText = text;
  div.style.color = "tomato";
  field.insertAdjacentElement("afterend", div);
}
function toggleErrorField(field, show) {
  const errorText = field.nextElementSibling;
  if (errorText !== null) {
    if (errorText.classList.contains("form-error-text")) {
      errorText.style.display = show ? "block" : "none";
      errorText.setAttribute("aria-hidden", show);
    }
  }
}

function markFieldAsError(field, hasError) {
  if (hasError) {
    field.classList.add("field-error");
  } else {
    field.classList.remove("field-error");
    toggleErrorField(field, false);
  }
}
let i = 0;
const form = document.querySelectorAll("form");
console.log("ok")

form.forEach((item) => {
  item.setAttribute("novalidate", true);
});


form.forEach((formularz) => {
  formularz.addEventListener("submit", (e) => {
    e.preventDefault();
    let inputs = formularz.querySelectorAll("input");
    let formHasErrors = false;
    for (const el of inputs) {
      el.addEventListener("input", (e) =>
        markFieldAsError(e.target, !e.target.checkValidity())
      );
    }
    for (const el of inputs) {
      el.addEventListener("click", (e) => {
        removeFieldError(e.target);
      });
    }
    for (const el of inputs) {
      removeFieldError(el);
      el.classList.remove("field-error");
      if (!el.checkValidity()) {
          createFieldError(el, getFieldError(el));
        el.classList.add("field-error");
        formHasErrors = true;
      }
    }
  
    if (!formHasErrors) {
      e.target.submit();
    }
  });
  
})