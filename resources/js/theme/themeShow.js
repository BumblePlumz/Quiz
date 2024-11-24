document.addEventListener('DOMContentLoaded', function() { 
    const btnThemes = document.querySelectorAll('.btnTheme');

    btnThemes.forEach(btnTheme => {
        btnTheme.addEventListener('click', function() {
            const theme = this.dataset.name;
            window.location.href = `/dailyquiz/${theme}`;
        });
    });
});
