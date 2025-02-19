const formContainer = document.querySelector("#input-fill");
const mathematicalFormula = document.querySelector("#mathematical-formula");
const submitButton = document.querySelector("button[type='submit']");

const fields = {
  segitiga: [
    {
      label: "Masukan Alas:",
      type: "number",
      id: "alas",
      name: "alas",
    },
    {
      label: "Masukan Tinggi:",
      type: "number",
      id: "tinggi",
      name: "tinggi",
    },
  ],
  pythagoras: [
    {
      label: "Masukan A",
      type: "number",
      id: "a",
      name: "a",
    },
    {
      label: "Masukan B",
      type: "number",
      id: "b",
      name: "b",
    },
  ],
  lingkaran: [
    {
      label: "Masukan jari-jari",
      type: "number",
      id: "r",
      name: "r",
    },
  ],
  gaji_pokok: [
    {
      label: "Masukan Lama Kerja:",
      type: "number",
      id: "lama_kerja",
      name: "lama_kerja",
    },
    {
      label: "Pilih Golongan:",
      type: "radio",
      id: "golongan",
      name: "golongan",
      options: ["A", "B"],
    },
  ],
  nama_bulan: [
    {
      label: "Masukan Lama Kerja:",
      type: "number",
      id: "angka",
      name: "angka",
    },
  ],
};

formContainer.style.display = "none";
submitButton.style.display = "none";

mathematicalFormula.addEventListener("change", () => {
  clearForm();
  if (mathematicalFormula.value) {
    populateForm(mathematicalFormula.value);
    formContainer.style.display = "block";
    submitButton.style.display = "block";
  } else {
    formContainer.style.display = "none";
    submitButton.style.display = "none";
  }
});

function clearForm() {
  formContainer.innerHTML = "";
}

function populateForm(type) {
  const selectedFields = fields[type] || [];

  selectedFields.forEach((field) => {
    const fieldDiv = createFieldDiv(field);
    formContainer.appendChild(fieldDiv);
  });
}

function createFieldDiv(field) {
  const fieldDiv = document.createElement("div");
  fieldDiv.classList.add("field");

  const label = document.createElement("label");
  label.textContent = field.label;
  fieldDiv.appendChild(label);

  if (field.type === "radio") {
    createRadioInputs(field, fieldDiv);
  } else {
    createTextInput(field, fieldDiv);
  }

  return fieldDiv;
}

function createRadioInputs(field, container) {
  let radioHtml = "";
  field.options.forEach((option) => {
    radioHtml += `
                    <input type="radio" id="${option}" name="${field.name}" value="${option}" required />
                    <label for="${option}">${option}</label>
                `;
  });
  container.innerHTML += radioHtml;
}

function createTextInput(field, container) {
  container.innerHTML += `
                <input type="${field.type}" id="${field.id}" name="${field.name}" required />
            `;
}
