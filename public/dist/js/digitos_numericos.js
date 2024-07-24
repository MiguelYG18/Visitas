$('#documento,#dni').on('input', function () {
    this.value = this.value.replace(/\D/g, '');
});