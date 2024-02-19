var labels = document.querySelectorAll('.typerace');


labels.forEach(function(label) {
    var text = label.textContent; 
    label.textContent = ''; 
    var index = 0;

    function type() {
        label.textContent += text[index]; 
        index++;

        if (index < text.length) {
            setTimeout(type, 500); 
        }
    }

    type();
});