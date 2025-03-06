document.getElementById('notifyBtn').addEventListener('click', function() {
    const notification = document.getElementById('notification');
    notification.classList.add('show');
    notification.classList.remove('hidden');
    
    setTimeout(() => {
        notification.classList.add('hide');
        setTimeout(() => {
            notification.classList.remove('show');
            notification.classList.add('hidden');
            notification.classList.remove('hide');
        }, 1000);
    }, 3000);
});
