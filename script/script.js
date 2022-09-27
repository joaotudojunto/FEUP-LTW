
    const namebox = document.getElementById('name');
    const locationbox = document.getElementById('location');
    const fstyle = document.getElementById('foodstyle');
    
    const checkbox1 = document.getElementById('c1');
    const checkbox2 = document.getElementById('c2');
    const checkbox3 = document.getElementById('c3');
    const checkbox4 = document.getElementById('c4');
    const checkbox5 = document.getElementById('c5');


    function searchAtrib(atribName, value) {
        var box = document.getElementById(atribName);
        var elements = document.getElementsByClassName("restaurant-card");

        for (var i=0; i<elements.length; i++) {
            var childElements = elements[i].querySelectorAll('.attrib');

            for(var j=0; j < childElements.length ; j++){

                console.log(childElements[j].value);

                if(box.value.length > 2 && childElements[j].getAttribute("name").includes(atribName)){
                    //console.log(childElements[j].value);
                    
                    if(childElements[j].getAttribute("value").toUpperCase().includes(value.toUpperCase())){
                        elements[i].style.display = 'block';
                    }else{
                        elements[i].style.display = 'none';
                    }
                }else if(childElements[j].getAttribute("name")==atribName && box.value.length < 2){
                    elements[i].style.display = 'block';
                }
            }
        }
    }

    function searchAtribRating(checkbox1, checkbox2, checkbox3, checkbox4, checkbox5) {
        var elements = document.getElementsByClassName("restaurant-card");
        var values= new Array();

        if (document.getElementById('c1').checked) {
            values[0] = 1;
        } else {
           values[0] = 0;
        }

        if (document.getElementById('c2').checked) {
            values[1] = 2;
        } else {
            values[1] = 0;
        }

        if (document.getElementById('c3').checked) {
            values[2] = 3;
        } else {
            values[2] = 0;
        }
        
        if (document.getElementById('c4').checked) {
            values[3] = 4;
        } else {
            values[3] = 0;
        }

        if (document.getElementById('c5').checked) {
            values[4] = 5;
        } else {
            values[4] = 0;
        }

        

        for (var i=0; i<elements.length; i++) {
            var childElements = elements[i].querySelectorAll('.attrib');

            for(var j=0; j < childElements.length ; j++){

                if(childElements[j].getAttribute("name").includes("rating") ){
                    console.log(childElements[j].value);

                    if(childElements[j].getAttribute("value")==values[0] 
                    || childElements[j].getAttribute("value")==values[1]
                    || childElements[j].getAttribute("value")==values[2]
                    || childElements[j].getAttribute("value")==values[3]
                    || childElements[j].getAttribute("value")==values[4]){
                        elements[i].style.display = 'block';
                    }else{
                        elements[i].style.display = 'none';
                    }
                }
            }
        }
    }

    checkbox1.addEventListener('change', (event) => {
        searchAtribRating(checkbox1, checkbox2, checkbox3, checkbox4, checkbox5);
    })

    checkbox2.addEventListener('change', (event) => {
        searchAtribRating(checkbox1, checkbox2, checkbox3, checkbox4, checkbox5);
    })
    checkbox3.addEventListener('change', (event) => {
        searchAtribRating(checkbox1, checkbox2, checkbox3, checkbox4, checkbox5);
    })
    checkbox4.addEventListener('change', (event) => {
        searchAtribRating(checkbox1, checkbox2, checkbox3, checkbox4, checkbox5);
    })
    checkbox5.addEventListener('change', (event) => {
        searchAtribRating(checkbox1, checkbox2, checkbox3, checkbox4, checkbox5);
    })


    const nameHandler = function(e) {
        searchAtrib("name", namebox.value);
    }
    const locHandler = function(e) {
        searchAtrib("location", locationbox.value);
    }
    const styleHander = function(e) {
        searchAtrib("foodstyle", fstyle.value);
    }

    namebox.addEventListener('input', nameHandler);
    locationbox.addEventListener('input', locHandler);
    fstyle.addEventListener('input', styleHander);
