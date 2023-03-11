window.onload = function () {
    ShowHide();
    checkSKU();
    SubmitForm();
}

function SubmitForm() {
    let forms = document.querySelectorAll('.needs-validation');
    Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated')
        })
    });
}

function ShowHide() {
    const Elements = {
        Book: `    <div id="Book" class="row m-3 p-2 border border-dark">
                        <input class="d-none" type="text" name="category-unit" value="Weight|KG">
                        <div class="col-12">
                            <label for="weight" class="form-label m-0">Weight (KG)</label>
                            <input type="number" min="0" step="0.01" placeholder="weight" id="weight" name="Book" value="weight" required>
                            <div class="valid-feedback">correct</div>
                            <div class="invalid-feedback">no weight given!</div>
                        </div>
                    </div>`,
        DVD: `    <div id="DVD" class="row m-3 p-2 border border-dark">
                       <input class="d-none" type="text" name="category-unit" value="Size|MB">
                       <div class="col-12">
                           <label for="size" class="form-label m-0">Size (MB)</label>
                           <input type="number" min="0" placeholder="size" id="size" name="DVD" value="size" required>
                           <div class="valid-feedback">correct</div>
                           <div class="invalid-feedback">Please, provide size</div>
                       </div>
                   </div>`,
        Furniture: `<div id="Furniture" class="row m-3 p-2 border border-dark">
                        <input class="d-none" type="text" name="category-unit" value="Dimension| ">
                        <div class="col-12 m-1">
                            <label for="height" class="form-label m-0">Height (CM)</label>
                            <input type="number" min="0" placeholder="height" id="height" name="Furniture[]" value="height" required>
                            <div class="valid-feedback">correct</div>
                            <div class="invalid-feedback">no height given!</div>
                        </div>
                        <div class="col-12 m-1">
                            <label for="width" class="form-label m-0">Width (CM)</label>
                            <input type="number" min="0" placeholder="width" id="width" name="Furniture[]" value="width" required>
                            <div class="valid-feedback">correct</div>
                            <div class="invalid-feedback">no width given!</div>
                        </div>
                        <div class="col-12 m-1">
                            <label for="length" class="form-label m-0">Length (CM)</label>
                            <input type="number" min="0" placeholder="length" id="length" name="Furniture[]" value="length" required>
                            <div class="valid-feedback">correct</div>
                            <div class="invalid-feedback">no length given!</div>
                        </div>
                    </div>`
    }


    let select = document.getElementById('productType');
    select.addEventListener('change', function (event) {
        let attrDiv = document.getElementById('attributes');
        while (attrDiv.firstChild){
            attrDiv.removeChild(attrDiv.firstChild)
        }
        for(key in Elements){
            if (key === event.target.value){

                let newEl = document.createElement('div');
                newEl.innerHTML = `${Elements[key]}`;
                attrDiv.appendChild(newEl);
            }
        }

    });
}

async function checkSKU() {
    const response = await fetch('ask_to_db.php')
    const data = await response.json();

    let SKUinput = document.getElementById('sku');
    SKUinput.addEventListener('input', function () {
        if (data.includes(SKUinput.value)) {
            SKUinput.setCustomValidity('Invalid field')
        } else {
            SKUinput.setCustomValidity('')
        }
    });
}



