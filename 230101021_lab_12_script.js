document.addEventListener('DOMContentLoaded', function() {
    const designForm = document.getElementById('designForm');
    const cardPreview = document.getElementById('cardPreview');

    if (designForm) {
        designForm.addEventListener('input', updatePreview);
        designForm.addEventListener('change', updatePreview);
    }

    function updatePreview() {
        const name = document.getElementById('name').value;
        const designation = document.getElementById('designation').value;
        const email = document.getElementById('email').value;
        const mobile = document.getElementById('mobile').value;
        const organization = document.getElementById('organization').value;
        const format = document.getElementById('format').value;
        const primaryColor = document.getElementById('primary_color').value;
        const secondaryColor = document.getElementById('secondary_color').value;
        const textColor = document.getElementById('text_color').value;

        cardPreview.className = `card format${format}`;
        cardPreview.style.backgroundColor = secondaryColor;
        cardPreview.style.color = textColor;

        cardPreview.innerHTML = `
            <div class="logo" style="background-color: ${primaryColor};"></div>
            <div class="name">${name}</div>
            <div class="designation">${designation}</div>
            <div class="organization">${organization}</div>
            <div class="contact">
                <div>${email}</div>
                <div>${mobile}</div>
            </div>
        `;
    }
});
