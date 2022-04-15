/* Champs de notre FormBuilder mis à jour des champs value et placeholder */
function replacePlaceholderByValue() {

    Array.from(document.querySelectorAll(".build-element")).forEach((element) => {

        /* fonction générer id aléatoire */
        let id = () => {
            return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
        }

        /* concaténer l'id avec la chaine existante qui donne par exemple : changeInputc3b1, changeInputd9bv */
        var champsID = id();
        element.id = "changeInput" + champsID;

        /* récupérer l'id et la valeur de son champs */
        var locatechangeInput = document.getElementById("changeInput" + champsID);
        var strInput = document.getElementById("changeInput" + champsID).value;

        /* si l'on a bien récupérer le champs */
        if (locatechangeInput) {
            /* Si l'utilisateur modifie le champs : value non vide */
            if (strInput.length != 0) {
                /* le placeholder prend la nouvelle valeur et la valeur est actualisé */
                document.getElementById("changeInput" + champsID).placeholder = document.getElementById("changeInput" + champsID).value;
                document.getElementById("changeInput" + champsID).value = document.getElementById("changeInput" + champsID).placeholder;
            }
        }
    });
}

// Range : pour definir la progression du formulaire
var rangeSlider = function () {
    var slider = $('.range-slider'),
        range = $('.range-slider__range'),
        value = $('.range-slider__value');

    slider.each(function () {

        value.each(function () {
            var value = $(this).prev().attr('value');
            $(this).html(value);
        });

        range.on('input', function () {
            $(this).next(value).html(this.value);
        });
    });
};

rangeSlider();






window.jsPDF = window.jspdf.jsPDF;
const doc = new jsPDF({
    orientation: "landscape",
    unit: "in",
    format: [8, 4],
});
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

const db = localStorage;

const _ = (el) => {
    return document.querySelector(el);
};

/* récupérer nos elements html partie gauche */
const getTpl = (element) => {
    return tpl[element];
};

/* rendre les champs éditable */
const makeEditable = () => {
    let elements = document.querySelectorAll('.drop-element');
    let toArr = Array.prototype.slice.call(elements);
    Array.prototype.forEach.call(toArr, (obj, index) => {
        if (obj.querySelector('img')) {
            return false;
        } else {
            obj.addEventListener('click', (e) => {
                e.preventDefault();
                obj.children[0].setAttribute('contenteditable', '');
                obj.focus();
            });
            obj.children[0].addEventListener('blur', (e) => {
                e.preventDefault();
                obj.children[0].removeAttribute('contenteditable');
            });
        }
    });
};

/* Préparation pour la sauvegarde PDF */
const removeDivsToSave = () => {
    let elements = document.querySelectorAll('.drop-element');
    let toArr = Array.prototype.slice.call(elements);
    let html = '';
    Array.prototype.forEach.call(toArr, (obj, index) => {
        obj.children[0].removeAttribute('contenteditable');
        html += obj.innerHTML;
    });
    return html;
};

/* Nos éléments dropable html partie gauche du FormBuilder */
const tpl = {
    'header1': '<label class="build-element">Entrez un label</label>',
    'header2': '<input class="build-input build-element" id="changeInput" placeholder="Entrez un texte" value=""/>',
    'header3': '<textarea class="build-element" rows="2" cols="50" id="changeArea" placeholder="Entrez un long texte"></textarea>',
    'checkbox': '<div><input type="checkbox" id="InputCheck"></div>',
    'checkbox-check': '<div><input type="checkbox" id="InputCheck" checked></div>',
    // 'shortparagraph': '<select class="build-element" id="cars"><option value="volvo">Valeur1</option> <option value="saab">Valeur2</option> <option value="fiat">Valeur3</option> <option value="audi">Valeur4</option> </select>',
    'image': '<input type="file" width="150" height="150" name="file" id="inputGroupFile02" class="inputGroup"> <img class="image-selector" src="#" alt="your image" />'
};

/**
 * init dragula
 *
 * @type  function
 */
const containers = [_('.box-left'), _('.box-rightsave')];
const drake = dragula(containers, {
    copy(el, source) {
        return source === _('.box-left');
    },
    accepts(el, target) {
        return target !== _('.box-left');
    }
});
dragula([document.getElementsByClassName('.drop-element')], {
    removeOnSpill: true
});


drake.on('out', (el, container) => {
    console.log(el)
    if (container == _('.box-rightsave')) {
        el.innerHTML = getTpl(el.getAttribute('data-tpl'));
        el.className = 'drop-element';
        if (el.getAttribute('data-tpl') != "image") {
            makeEditable();
        }
        db.setItem('savedData', _('.box-rightsave').innerHTML);
    }
    if (container == _('.box-left')) {
        el.innerHTML = el.getAttribute('data-title');
    }
});

if (typeof db.getItem('savedData') !== 'undefined') {
    //db.setItem('savedData', _('.box-rightsave').innerHTML);
    // db.setItem('savedData', _('.box-rightsave').innerHTML);
    //_('.box-rightsave').innerHTML = db.getItem('savedData'); /* problème affichage dans edit */
    makeEditable();
};

/* Réinitialisation du contenue de la div avec alerte */
_('.reset').addEventListener('click', (e) => {

    e.preventDefault();
    db.removeItem('savedData');
    if (confirm('En êtes-vous sûr !?')) {
        _('.box-rightsave').innerHTML = '';
    }
});

/* Conversion PDF format blob */
_('.save').addEventListener('click', (e) => {
    e.preventDefault();
    var blob = new Blob([removeDivsToSave()], {
        type: 'text/html;charset=utf-8'
    });
    db.setItem('savedData', _('.box-rightsave').innerHTML);
});

$(document).ready(function () {
    // $(document).on("click","input[name=file]",function () {
    //     console.log($('.custom-file-input').click());
    //     // $(this)[0].trigger("click");
    //     // $(this).trigger("input[name=file]");
    //
    //
    // });

    $(document).on("dblclick", ".drop-element", function () {
        $(this).remove();
        db.removeItem('savedData');
        db.setItem('savedData', $("#contents-2").html())
    })
    /* fermeture message */
    setTimeout(function () {
        $(".close-message").hide();
    }, 2000)
    /* Enregistrement */
    $(".form-submit").on("click", function (e) {
        e.preventDefault();
        $("#form-data").val(JSON.stringify($("#contents-2").html()));
        $("#form-builder").submit();
        db.removeItem('savedData');
    });
    /* Champs Image */
    $(document).on('change', '.inputGroup', function (input) {
        input = input.currentTarget;
        let _that = $(this);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {

                _that.siblings('.image-selector').attr('src', e.target.result).width(150).height(150);

            };

            reader.readAsDataURL(input.files[0]);

            setTimeout(function () {
                db.removeItem('savedData');
                db.setItem('savedData', $("#contents-2").html())
            }, 1000)
        }
    });
    /* PDF format canvas */
    $(".save").on("click", function () {
        html2canvas(document.querySelector("#contents-2")).then(canvas => {
            document.body.appendChild(canvas)
            var myImage = canvas.toDataURL("image/jpeg,1.0");
            // Ajuster la largeur et la hauteur
            var imgWidth = (canvas.width * 120) / 650;
            var imgHeight = (canvas.height * 70) / 340;
            // Modifications du jspdf
            var pdf = new jsPDF('p', 'mm', 'a4');
            pdf.addImage(myImage, 'png', 15, 2, imgWidth, imgHeight); // 2: 19
            /* Fichier PDF */
            pdf.save(`FormBuilderPDF.pdf`);
        });

    })
})
