const left = document.querySelector('.left');
const right = document.querySelector('.right');
const botL = document.querySelector('.top');
const botR = document.querySelector('.bottom');

new Sortable(left, {
    group: 'shared', // set both lists to same group
    animation: 150
});

new Sortable(right, {
    group: 'shared',
    animation: 150
});
new Sortable(botL, {
    group: 'shared',
    animation: 150
});
new Sortable(botR, {
    group: 'shared',
    animation: 150
});