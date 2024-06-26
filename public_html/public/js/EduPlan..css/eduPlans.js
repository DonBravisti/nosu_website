console.log('aga');
function ConfirmDeleteTitlePlan() {
    return confirm('Удалить титульный лист вместе с планом?');
}

function ConfirmDeleteEduPlan() {
    return confirm('Вы уверены? План будет удалён безвозвратно.');
}

function ConfirmDelete() {
    return ConfirmDeleteEduPlan();
    // ConfirmDeleteTitlePlan();
}
