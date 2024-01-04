"use strict";
!function(NioApp, $) {
    var refBarChart = {
        labels: ["01 Nov", "02 Nov", "03 Nov", "04 Nov", "05 Nov", "06 Nov", "07 Nov", "08 Nov", "09 Nov", "10 Nov", "11 Nov", "12 Nov", "13 Nov", "14 Nov", "15 Nov", "16 Nov", "17 Nov", "18 Nov", "19 Nov", "20 Nov", "21 Nov", "22 Nov", "23 Nov", "24 Nov", "25 Nov", "26 Nov", "27 Nov", "28 Nov", "29 Nov", "30 Nov"],
        dataUnit: "People",
        datasets: [{
            label: "Join",
            color: "#9cabff",
            data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 75, 90]
        }]
    }
      , profitCM = {
        labels: ["01 Nov", "02 Nov", "03 Nov", "04 Nov", "05 Nov", "06 Nov", "07 Nov", "08 Nov", "09 Nov", "10 Nov", "11 Nov", "12 Nov", "13 Nov", "14 Nov", "15 Nov", "16 Nov", "17 Nov", "18 Nov", "19 Nov", "20 Nov", "21 Nov", "22 Nov", "23 Nov", "24 Nov", "25 Nov", "26 Nov", "27 Nov", "28 Nov", "29 Nov", "30 Nov"],
        dataUnit: "USD",
        datasets: [{
            label: "Send",
            color: "#5d7ce0",
            data: [0, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 75, 0]
        }]
    };
    function referStats(elem, set_data) {
        var $elem = $(elem || ".chart-refer-stats");
        $elem.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: "transparent",
                    hoverBorderColor: "transparent",
                    borderSkipped: "bottom",
                    barPercentage: .5,
                    categoryPercentage: .7
                });
            var chart = new Chart(selectCanvas,{
                type: "bar",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    legend: {
                        display: !1
                    },
                    maintainAspectRatio: !1,
                    tooltips: {
                        enabled: !0,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function(a, t) {
                                return !1
                            },
                            label: function(a, t) {
                                return t.datasets[a.datasetIndex].data[a.index] + " " + _get_data.dataUnit
                            }
                        },
                        backgroundColor: "#fff",
                        titleFontSize: 11,
                        titleFontColor: "#6783b8",
                        titleMarginBottom: 4,
                        bodyFontColor: "#9eaecf",
                        bodyFontSize: 10,
                        bodySpacing: 3,
                        yPadding: 8,
                        xPadding: 8,
                        footerMarginTop: 0,
                        displayColors: !1
                    },
                    scales: {
                        yAxes: [{
                            display: !1,
                            ticks: {
                                beginAtZero: !0
                            }
                        }],
                        xAxes: [{
                            display: !1,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }]
                    }
                }
            })
        })
    }
    function investProfit(elem, set_data) {
        var $elem = $(elem || ".chart-profit");
        $elem.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension: .4,
                    backgroundColor: NioApp.hexRGB(_get_data.datasets[i].color, .3),
                    borderWidth: 2,
                    borderColor: _get_data.datasets[i].color,
                    pointBorderColor: "transparent",
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: _get_data.datasets[i].color,
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 2,
                    pointRadius: 4,
                    pointHitRadius: 4,
                    data: _get_data.datasets[i].data
                });
            var chart = new Chart(selectCanvas,{
                type: "line",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    legend: {
                        display: !1
                    },
                    maintainAspectRatio: !1,
                    tooltips: {
                        enabled: !0,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function(a, t) {
                                return !1
                            },
                            label: function(a, t) {
                                return t.datasets[a.datasetIndex].data[a.index] + " " + _get_data.dataUnit
                            }
                        },
                        backgroundColor: "#fff",
                        titleFontSize: 11,
                        titleFontColor: "#6783b8",
                        titleMarginBottom: 4,
                        bodyFontColor: "#9eaecf",
                        bodyFontSize: 10,
                        bodySpacing: 3,
                        yPadding: 8,
                        xPadding: 8,
                        footerMarginTop: 0,
                        displayColors: !1
                    },
                    scales: {
                        yAxes: [{
                            display: !1,
                            ticks: {
                                beginAtZero: !0
                            }
                        }],
                        xAxes: [{
                            display: !1,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }]
                    }
                }
            })
        })
    }
    NioApp.coms.docReady.push(function() {
        referStats()
    }),
    NioApp.coms.docReady.push(function() {
        investProfit()
    });
    var profileBalance = {
        labels: ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"],
        dataUnit: "BTC",
        lineTension: .15,
        datasets: [{
            label: "Total Received",
            color: "#798bff",
            background: NioApp.hexRGB("#798bff", .3),
            data: [111, 80, 125, 75, 95, 75, 90, 111, 80, 125, 75, 95, 75, 90, 111, 80, 125, 75, 95, 75, 90, 111, 80, 125, 75, 95, 75, 90, 75, 90]
        }]
    };
    function lineProfileBalance(selector, set_data) {
        var $selector = $(selector || ".profile-balance-chart");
        $selector.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    tension: _get_data.lineTension,
                    backgroundColor: _get_data.datasets[i].background,
                    borderWidth: 2,
                    borderColor: _get_data.datasets[i].color,
                    pointBorderColor: "transparent",
                    pointBackgroundColor: "transparent",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: _get_data.datasets[i].color,
                    pointBorderWidth: 2,
                    pointHoverRadius: 3,
                    pointHoverBorderWidth: 2,
                    pointRadius: 3,
                    pointHitRadius: 3,
                    data: _get_data.datasets[i].data
                });
            var chart = new Chart(selectCanvas,{
                type: "line",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    legend: {
                        display: !1
                    },
                    maintainAspectRatio: !1,
                    tooltips: {
                        enabled: !0,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function(a, t) {
                                return !1
                            },
                            label: function(a, t) {
                                return t.datasets[a.datasetIndex].data[a.index] + " " + _get_data.dataUnit
                            }
                        },
                        backgroundColor: "#eff6ff",
                        titleFontSize: 11,
                        titleFontColor: "#6783b8",
                        titleMarginBottom: 4,
                        bodyFontColor: "#9eaecf",
                        bodyFontSize: 10,
                        bodySpacing: 3,
                        yPadding: 8,
                        xPadding: 8,
                        footerMarginTop: 0,
                        displayColors: !1
                    },
                    scales: {
                        yAxes: [{
                            display: !1
                        }],
                        xAxes: [{
                            display: !1,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }]
                    }
                }
            })
        })
    }
    NioApp.coms.docReady.push(function() {
        lineProfileBalance()
    });
    var totalDeposit = {
        labels: ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan"],
        dataUnit: "USD",
        stacked: !0,
        datasets: [{
            label: "Active User",
            color: [NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), NioApp.hexRGB("#6576ff", .2), "#6576ff"],
            data: [7200, 8200, 7800, 9500, 5500, 9200, 9690]
        }]
    }
      , totalWithdraw = {
        labels: ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan"],
        dataUnit: "USD",
        stacked: !0,
        datasets: [{
            label: "Active User",
            color: [NioApp.hexRGB("#816bff", .2), NioApp.hexRGB("#816bff", .2), NioApp.hexRGB("#816bff", .2), NioApp.hexRGB("#816bff", .2), NioApp.hexRGB("#816bff", .2), NioApp.hexRGB("#816bff", .2), "#816bff"],
            data: [7200, 8200, 7800, 9500, 5500, 9200, 9690]
        }]
    }
      , totalBalance = {
        labels: ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan"],
        dataUnit: "USD",
        stacked: !0,
        datasets: [{
            label: "Active User",
            color: [NioApp.hexRGB("#559bfb", .2), NioApp.hexRGB("#559bfb", .2), NioApp.hexRGB("#559bfb", .2), NioApp.hexRGB("#559bfb", .2), NioApp.hexRGB("#559bfb", .2), NioApp.hexRGB("#559bfb", .2), "#559bfb"],
            data: [6e3, 8200, 7800, 9500, 5500, 9200, 9690]
        }]
    };
    function ivDataChart(selector, set_data) {
        var $selector = $(selector || ".iv-data-chart");
        $selector.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, _d_legend = void 0 !== _get_data.legend && _get_data.legend, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: "transparent",
                    hoverBorderColor: "transparent",
                    borderSkipped: "bottom",
                    barPercentage: .7,
                    categoryPercentage: .7
                });
            var chart = new Chart(selectCanvas,{
                type: "bar",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    legend: {
                        display: _get_data.legend || !1,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth: 30,
                            padding: 20,
                            fontColor: "#6783b8"
                        }
                    },
                    maintainAspectRatio: !1,
                    tooltips: {
                        enabled: !0,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function(a, t) {
                                return !1
                            },
                            label: function(a, t) {
                                return t.labels[a.index] + " " + t.datasets[a.datasetIndex].data[a.index]
                            }
                        },
                        backgroundColor: "#eff6ff",
                        titleFontSize: 11,
                        titleFontColor: "#6783b8",
                        titleMarginBottom: 4,
                        bodyFontColor: "#9eaecf",
                        bodyFontSize: 10,
                        bodySpacing: 3,
                        yPadding: 8,
                        xPadding: 8,
                        footerMarginTop: 0,
                        displayColors: !1
                    },
                    scales: {
                        yAxes: [{
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                beginAtZero: !0
                            }
                        }],
                        xAxes: [{
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }]
                    }
                }
            })
        })
    }
    NioApp.coms.docReady.push(function() {
        ivDataChart()
    });
    var planPurchase = {
        labels: ["01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan", "01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan", "01 Jan", "02 Jan", "03 Jan", "04 Jan", "05 Jan", "06 Jan", "07 Jan"],
        dataUnit: "USD",
        stacked: !0,
        datasets: [{
            label: "Active User",
            color: NioApp.hexRGB("#6576ff", .2),
            colorHover: "#6576ff",
            data: [6e3, 8200, 7800, 9500, 5500, 9200, 9690, 6e3, 8200, 7800, 9500, 5500, 9200, 9690, 6e3, 8200, 7800, 9500, 5500, 9200, 9690]
        }]
    };
    function ivPlanPurchase(selector, set_data) {
        var $selector = $(selector || ".iv-plan-purchase");
        $selector.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, _d_legend = void 0 !== _get_data.legend && _get_data.legend, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    backgroundColor: _get_data.datasets[i].color,
                    hoverBackgroundColor: _get_data.datasets[i].colorHover,
                    borderWidth: 2,
                    borderColor: "transparent",
                    hoverBorderColor: "transparent",
                    borderSkipped: "bottom",
                    barPercentage: .7,
                    categoryPercentage: .7
                });
            var chart = new Chart(selectCanvas,{
                type: "bar",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    legend: {
                        display: _get_data.legend || !1,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth: 30,
                            padding: 20,
                            fontColor: "#6783b8"
                        }
                    },
                    maintainAspectRatio: !1,
                    tooltips: {
                        enabled: !0,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function(a, t) {
                                return !1
                            },
                            label: function(a, t) {
                                return t.labels[a.index] + " " + t.datasets[a.datasetIndex].data[a.index]
                            }
                        },
                        backgroundColor: "#eff6ff",
                        titleFontSize: 11,
                        titleFontColor: "#6783b8",
                        titleMarginBottom: 4,
                        bodyFontColor: "#9eaecf",
                        bodyFontSize: 10,
                        bodySpacing: 3,
                        yPadding: 8,
                        xPadding: 8,
                        footerMarginTop: 0,
                        displayColors: !1
                    },
                    scales: {
                        yAxes: [{
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                beginAtZero: !0
                            }
                        }],
                        xAxes: [{
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }]
                    }
                }
            })
        })
    }
    NioApp.coms.docReady.push(function() {
        ivPlanPurchase()
    });
    var userActivity = {
        labels: ["01 Nov", "02 Nov", "03 Nov", "04 Nov", "05 Nov", "06 Nov", "07 Nov", "08 Nov", "09 Nov", "10 Nov", "11 Nov", "12 Nov", "13 Nov", "14 Nov", "15 Nov", "16 Nov", "17 Nov", "18 Nov", "19 Nov", "20 Nov", "21 Nov"],
        dataUnit: "Person",
        stacked: !0,
        datasets: [{
            label: "Direct Join",
            color: "#9cabff",
            data: [110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90]
        }, {
            label: "Referral Join",
            color: "#ccd4ff",
            data: [125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 110, 80, 125, 55, 95, 75, 90, 75, 90]
        }]
    };
    function userActivityChart(selector, set_data) {
        var $selector = $(selector || ".usera-activity-chart");
        $selector.each(function() {
            for (var $self = $(this), _self_id = $self.attr("id"), _get_data = void 0 === set_data ? eval(_self_id) : set_data, _d_legend = void 0 !== _get_data.legend && _get_data.legend, selectCanvas = document.getElementById(_self_id).getContext("2d"), chart_data = [], i = 0; i < _get_data.datasets.length; i++)
                chart_data.push({
                    label: _get_data.datasets[i].label,
                    data: _get_data.datasets[i].data,
                    backgroundColor: _get_data.datasets[i].color,
                    borderWidth: 2,
                    borderColor: "transparent",
                    hoverBorderColor: "transparent",
                    borderSkipped: "bottom",
                    barPercentage: .7,
                    categoryPercentage: .7
                });
            var chart = new Chart(selectCanvas,{
                type: "bar",
                data: {
                    labels: _get_data.labels,
                    datasets: chart_data
                },
                options: {
                    legend: {
                        display: _get_data.legend || !1,
                        rtl: NioApp.State.isRTL,
                        labels: {
                            boxWidth: 30,
                            padding: 20,
                            fontColor: "#6783b8"
                        }
                    },
                    maintainAspectRatio: !1,
                    tooltips: {
                        enabled: !0,
                        rtl: NioApp.State.isRTL,
                        callbacks: {
                            title: function(a, t) {
                                return t.datasets[a[0].datasetIndex].label
                            },
                            label: function(a, t) {
                                return t.datasets[a.datasetIndex].data[a.index] + " " + _get_data.dataUnit
                            }
                        },
                        backgroundColor: "#eff6ff",
                        titleFontSize: 13,
                        titleFontColor: "#6783b8",
                        titleMarginBottom: 6,
                        bodyFontColor: "#9eaecf",
                        bodyFontSize: 12,
                        bodySpacing: 4,
                        yPadding: 10,
                        xPadding: 10,
                        footerMarginTop: 0,
                        displayColors: !1
                    },
                    scales: {
                        yAxes: [{
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                beginAtZero: !0
                            }
                        }],
                        xAxes: [{
                            display: !1,
                            stacked: _get_data.stacked || !1,
                            ticks: {
                                reverse: NioApp.State.isRTL
                            }
                        }]
                    }
                }
            })
        })
    }
    NioApp.coms.docReady.push(function() {
        userActivityChart()
    })
}(NioApp, jQuery);
