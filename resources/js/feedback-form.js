document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('visitor-feedback-form');

    if (!form) {
        return;
    }

    const genderOtherInput = form.querySelector('#gender_other');
    const genderInputs = form.querySelectorAll('input[name="gender"]');

    const syncGenderOther = () => {
        if (!genderOtherInput) {
            return;
        }

        const selected = form.querySelector('input[name="gender"]:checked');
        const show = selected?.value === 'other';
        genderOtherInput.toggleAttribute('required', show);
        genderOtherInput.setAttribute('aria-required', String(show));
    };

    genderInputs.forEach((input) => input.addEventListener('change', syncGenderOther));
    syncGenderOther();
});
