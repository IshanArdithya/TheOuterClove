  const tabs = document.querySelectorAll('.tab-item');
  const indicator = document.querySelector('.tab-indicator');

  function setIndicatorPosition(activeTab) {
    const tabRect = activeTab.getBoundingClientRect();
    const containerRect = document.querySelector('.menu-tabs').getBoundingClientRect();

    indicator.style.width = `${tabRect.width}px`;
    indicator.style.left = `${tabRect.left - containerRect.left}px`;
  }

  const activeTab = document.querySelector('.tab-item.active');
  if (activeTab) setIndicatorPosition(activeTab);

  tabs.forEach(tab => {
    tab.addEventListener('click', function (e) {
      e.preventDefault();

      tabs.forEach(t => t.classList.remove('active'));

      tab.classList.add('active');

      setIndicatorPosition(tab);
    });
  });
