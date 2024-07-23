document.querySelectorAll('.numeric-only').forEach((el) => {
    el.addEventListener('input', function (e) {
        this.value = this.value.replace(/\D/g, '');
    });
});

function togglePassword(event, id) {
    const input = document.getElementById(id);
    if (input.type === 'password') {
        input.type = 'text';
        event.innerHTML = 'Hide';
    } else {
        input.type = 'password';
        event.innerHTML = 'Show';
    }
}
