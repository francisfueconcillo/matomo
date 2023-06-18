<template>
  <div style="padding: 0 8px 8px 8px;">
    <span>
      {{ siteTime }} - <strong>Site</strong> {{ sitetz }}
    </span>
    <br>
    <span>
      {{ localTime }} - <strong>Local</strong> {{ localtz }}
    </span>
  </div>
</template>

<script lang="ts">

type TimeWidgetData = {
  localTime: string,
  localtz: string,
  siteTime: string,
  timer: number,
}

const formatDate = (datetime, timeZone = null) => {
  const options = {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
  };

  if (timeZone) {
    return new Intl.DateTimeFormat('en-GB', { ...options, timeZone })
      .format(datetime)
      .replace(/\//g, '/')
      .replace(',', '');
  }

  return new Intl.DateTimeFormat('en-GB', options)
    .format(datetime)
    .replace(/\//g, '/')
    .replace(',', '');
};

export default {
  props: {
    sitetz: { type: String },
  },
  data():TimeWidgetData {
    const dateInit = new Date();
    return {
      localTime: formatDate(dateInit),
      localtz: Intl.DateTimeFormat().resolvedOptions().timeZone,
      siteTime: formatDate(dateInit, this.sitetz),
      timer: 0,
    };
  },
  mounted():void {
    this.timer = setInterval(() => {
      const now = new Date();
      this.siteTime = formatDate(now, this.sitetz);
      this.localTime = formatDate(now);
    }, 1000);
  },
  beforeUnmount():void {
    clearInterval(this.timer);
  },
};

</script>
