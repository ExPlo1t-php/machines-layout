const left = document.querySelector('.left');
const right = document.querySelector('.right');

new Sortable(left, {
    group: 'shared', // set both lists to same group
    animation: 150
});

new Sortable(right, {
    group: 'shared',
    animation: 150
});