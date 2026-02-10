

// Create Countdown
/*  var Countdown = {

      // Backbone-like structure
      $el: $('.countdown'),

      // Params
      countdown_interval: null,
      total_seconds     : 0,

      // Initialize the countdown
      init: function() {

          // DOM
          this.$ = {
              days  : this.$el.find('.bloc-time.days .figure'),
              hours  : this.$el.find('.bloc-time.hours .figure'),
              minutes: this.$el.find('.bloc-time.min .figure'),
              seconds: this.$el.find('.bloc-time.sec .figure')
          };

          // Init countdown values
          this.values = {
              days  : this.$.days.parent().attr('data-init-value'),
              hours  : this.$.hours.parent().attr('data-init-value'),
              minutes: this.$.minutes.parent().attr('data-init-value'),
              seconds: this.$.seconds.parent().attr('data-init-value'),
          };

          // Initialize total seconds
          this.total_seconds = this.values.days * 60 * 60 * 24 + this.values.hours * 60 * 60 + (this.values.minutes * 60) + this.values.seconds;

          // Animate countdown to the end
          this.count();
      },

      count: function() {

          var that    = this,
              $days_1 = this.$.hours.eq(0),
              $days_2 = this.$.hours.eq(1),
              $hour_1 = this.$.hours.eq(0),
              $hour_2 = this.$.hours.eq(1),
              $min_1  = this.$.minutes.eq(0),
              $min_2  = this.$.minutes.eq(1),
              $sec_1  = this.$.seconds.eq(0),
              $sec_2  = this.$.seconds.eq(1);

          this.countdown_interval = setInterval(function() {

              if(that.total_seconds > 0) {

                  --that.values.seconds;

                  if(that.values.minutes >= 0 && that.values.seconds < 0) {

                      that.values.seconds = 59;
                      --that.values.minutes;
                  }

                  if(that.values.hours >= 0 && that.values.minutes < 0) {

                      that.values.minutes = 59;
                      --that.values.hours;
                  }

                  if(that.values.days >= 0 && that.values.hours < 0) {

                      that.values.hours = 24;
                      --that.values.days;
                  }

                  // Update DOM values

                  // Days
                  that.checkHour(that.values.days, $days_1, $days_2);

                  // Hours
                  that.checkHour(that.values.hours, $hour_1, $hour_2);

                  // Minutes
                  that.checkHour(that.values.minutes, $min_1, $min_2);

                  // Seconds
                  that.checkHour(that.values.seconds, $sec_1, $sec_2);

                  --that.total_seconds;
              }
              else {
                  clearInterval(that.countdown_interval);
              }
          }, 1000);
      },

      animateFigure: function($el, value) {

          var that         = this,
              $top         = $el.find('.top'),
              $bottom      = $el.find('.bottom'),
              $back_top    = $el.find('.top-back'),
              $back_bottom = $el.find('.bottom-back');

          // Before we begin, change the back value
          $back_top.find('span').html(value);

          // Also change the back bottom value
          $back_bottom.find('span').html(value);

          // Then animate
          TweenMax.to($top, 0.8, {
              rotationX           : '-180deg',
              transformPerspective: 300,
              ease                : Quart.easeOut,
              onComplete          : function() {

                  $top.html(value);

                  $bottom.html(value);

                  TweenMax.set($top, { rotationX: 0 });
              }
          });

          TweenMax.to($back_top, 0.8, {
              rotationX           : 0,
              transformPerspective: 300,
              ease                : Quart.easeOut,
              clearProps          : 'all'
          });
      },

      checkHour: function(value, $el_1, $el_2) {

          var val_1       = value.toString().charAt(0),
              val_2       = value.toString().charAt(1),
              fig_1_value = $el_1.find('.top').html(),
              fig_2_value = $el_2.find('.top').html();

          if(value >= 10) {

              // Animate only if the figure has changed
              if(fig_1_value !== val_1) this.animateFigure($el_1, val_1);
              if(fig_2_value !== val_2) this.animateFigure($el_2, val_2);
          }
          else {

              // If we are under 10, replace first figure with 0
              if(fig_1_value !== '0') this.animateFigure($el_1, 0);
              if(fig_2_value !== val_1) this.animateFigure($el_2, val_1);
          }
      }
  };

  Countdown.init();*/

Vue.filter('zerofill', function (value) {
    //value = ( value < 0 ? 0 : value );
    return ( value < 10 && value > -1 ? '0' : '' ) + value;
});

var Tracker = Vue.extend({
    template: `
  <span v-show="show" class="flip-clock__piece">
    <span class="flip-clock__card flip-card">
      <b class="flip-card__top">{{current | zerofill}}</b>
      <b class="flip-card__bottom" data-value="{{current | zerofill}}"></b>
      <b class="flip-card__back" data-value="{{previous | zerofill}}"></b>
      <b class="flip-card__back-bottom" data-value="{{previous | zerofill}}"></b>
    </span>
    <span class="flip-clock__slot">{{name}}</span>
  </span>`,
    props: ['property','time','name'],
    data: () => ({
        current: 0,
        previous: 0,
        show: false
    }),

    events: {
        time(newValue) {

            if ( newValue[this.property] === undefined ) {
                this.show = false;
                return;
            }

            var val = newValue[this.property];
            this.show = true;

            val = ( val < 0 ? 0 : val );

            if ( val !== this.current ) {
                this.previous = this.current;
                this.current = val;

                this.$el.classList.remove('flip');
                void this.$el.offsetWidth;
                this.$el.classList.add('flip');
            }

        }
    },

});



var el = document.getElementById('timer');

var Countdown = new Vue({

    el: el,
    template: ` 
  <div class="flip-clock" data-date="2022-23-09" @click="update">
    <tracker 
      v-for="(key,tracker) in trackers"
      :property="tracker"
      :name="key"
      :time="time"
      v-ref:trackers
    ></tracker>
  </div>
  `,

    props: ['date','callback'],

    data: () => ({
        time: {},
        i: 0,
        trackers: {'Дней' : 'Days', 'Часов' : 'Hours','Минут' : 'Minutes','Секунд' : 'Seconds'}
        //trackers: ['Дней', 'Часов','Минут','Секунд'] //'Random',
    }),

    components: {
        Tracker
    },

    beforeDestroy(){
        if ( window['cancelAnimationFrame'] ) {
            cancelAnimationFrame(this.frame);
        }
    },

    watch: {
        'date': function(newVal){
            this.setCountdown(newVal);
        }
    },

    ready() {

        if ( window['requestAnimationFrame'] ) {
            this.date = $('#timer_date').val();
            this.setCountdown(this.date);
            this.callback = this.callback || function(){};
            this.update();
        }
    },

    methods: {

        setCountdown(date){

            if ( date ) {
                this.countdown = moment(date, 'YYYY-MM-DD HH:mm:ss');
            } else {
                this.countdown = moment().endOf('day');  //this.$el.getAttribute('data-date');
            }
        },

        update() {
            this.frame = requestAnimationFrame(this.update.bind(this));
            if ( this.i++ % 10 ) { return; }
            var t = moment(new Date());
            // Calculation adapted from https://www.sitepoint.com/build-javascript-countdown-timer-no-dependencies/
            if ( this.countdown ) {
                t = this.countdown.diff(t);

                //t = this.countdown.diff(t);//.getTime();
                //console.log(t);
                this.time.Days = Math.floor(t / (1000 * 60 * 60 * 24));
                this.time.Hours = Math.floor((t / (1000 * 60 * 60)) % 24);
                this.time.Minutes = Math.floor((t / 1000 / 60) % 60);
                this.time.Seconds = Math.floor((t / 1000) % 60);
            } else {
                this.time.Days = undefined;
                this.time.Hours = t.hours() % 13;
                this.time.Minutes = t.minutes();
                this.time.Seconds = t.seconds();
            }
            this.time.Total = t;
            this.$broadcast('time',this.time);
            return this.time;
        }
    }
});



