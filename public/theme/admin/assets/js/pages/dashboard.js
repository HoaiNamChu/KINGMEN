/**
* Theme: Larkon - Responsive Bootstrap 5 Admin Dashboard
* Author: Techzaa
* Module/App: Dashboard
*/

//
// Conversions
//
var options = {
    chart: {
        height: 292,
        type: 'radialBar',
    },
    plotOptions: {
        radialBar: {
            startAngle: -135,
            endAngle: 135,
            dataLabels: {
                name: {
                    fontSize: '14px',
                    color: "undefined",
                    offsetY: 100
                },
                value: {
                    offsetY: 55,
                    fontSize: '20px',
                    color: undefined,
                    formatter: function (val) {
                        return val + "%";
                    }
                }
            },
            track: {
                background: "rgba(170,184,197, 0.2)",
                margin: 0
            },
        }
    },
    fill: {
        gradient: {
            enabled: true,
            shade: 'dark',
            shadeIntensity: 0.2,
            inverseColors: false,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 65, 91]
        },
    },
    stroke: {
        dashArray: 4
    },
    colors: ["#ff6c2f", "#22c55e"],
    series: [65.2],
    labels: ['Returning Customer'],
    responsive: [{
        breakpoint: 380,
        options: {
            chart: {
                height: 180
            }
        }
    }],
    grid: {
        padding: {
            top: 0,
            right: 0,
            bottom: 0,
            left: 0
        }
    }
}

var chart = new ApexCharts(
    document.querySelector("#conversions"),
    options
);

chart.render();


//
//Performance-chart
//
var options = {
    series: [{
        name: "Page Views",
        type: "bar",
        data: [34, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67],
    },
    {
        name: "Clicks",
        type: "area",
        data: [8, 12, 7, 17, 21, 11, 5, 9, 7, 29, 12, 35],
    },
    ],
    chart: {
        height: 313,
        type: "line",
        toolbar: {
            show: false,
        },
    },
    stroke: {
        dashArray: [0, 0],
        width: [0, 2],
        curve: 'smooth'
    },
    fill: {
        opacity: [1, 1],
        type: ['solid', 'gradient'],
        gradient: {
            type: "vertical",
            inverseColors: false,
            opacityFrom: 0.5,
            opacityTo: 0,
            stops: [0, 90]
        },
    },
    markers: {
        size: [0, 0],
        strokeWidth: 2,
        hover: {
            size: 4,
        },
    },
    xaxis: {
        categories: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
        ],
        axisTicks: {
            show: false,
        },
        axisBorder: {
            show: false,
        },
    },
    yaxis: {
        min: 0,
        axisBorder: {
            show: false,
        }
    },
    grid: {
        show: true,
        strokeDashArray: 3,
        xaxis: {
            lines: {
                show: false,
            },
        },
        yaxis: {
            lines: {
                show: true,
            },
        },
        padding: {
            top: 0,
            right: -2,
            bottom: 0,
            left: 10,
        },
    },
    legend: {
        show: true,
        horizontalAlign: "center",
        offsetX: 0,
        offsetY: 5,
        markers: {
            width: 9,
            height: 9,
            radius: 6,
        },
        itemMargin: {
            horizontal: 10,
            vertical: 0,
        },
    },
    plotOptions: {
        bar: {
            columnWidth: "30%",
            barHeight: "70%",
            borderRadius: 3,
        },
    },
    colors: ["#ff6c2f", "#22c55e"],
    tooltip: {
        shared: true,
        y: [{
            formatter: function (y) {
                if (typeof y !== "undefined") {
                    return y.toFixed(1) + "k";
                }
                return y;
            },
        },
        {
            formatter: function (y) {
                if (typeof y !== "undefined") {
                    return y.toFixed(1) + "k";
                }
                return y;
            },
        },
        ],
    },
}

var chart = new ApexCharts(
    document.querySelector("#dash-performance-chart"),
    options
);

chart.render();


class VectorMap {


    initWorldMapMarker() {
        const map = new jsVectorMap({
            map: 'world',
            selector: '#world-map-markers',
            zoomOnScroll: true,
            zoomButtons: false,
            markersSelectable: true,
            markers: [
                { name: "Canada", coords: [56.1304, -106.3468] },
                { name: "Brazil", coords: [-14.2350, -51.9253] },
                { name: "Russia", coords: [61, 105] },
                { name: "China", coords: [35.8617, 104.1954] },
                { name: "United States", coords: [37.0902, -95.7129] }
            ],
            markerStyle: {
                initial: { fill: "#7f56da" },
                selected: { fill: "#22c55e" }
            },
            labels: {
                markers: {
                    render: marker => marker.name
                }
            },
            regionStyle: {
                initial: {
                    fill: 'rgba(169,183,197, 0.3)',
                    fillOpacity: 1,
                },
            },
        });
    }

    init() {
        this.initWorldMapMarker();
    }

}

document.addEventListener('DOMContentLoaded', function (e) {
    new VectorMap().init();

});

// thống kê doanh thu
document.addEventListener("DOMContentLoaded", function () {
    const chartOptions = {
        chart: {
            type: 'area',
            height: 350,
        },
        series: [
            {
                name: 'Revenue',
                data: []
            }
        ],
        xaxis: {
            categories: []
        },
        title: {
            text: 'Revenue statistics',
            align: 'left'
        },
        yaxis: {
            title: {
                text: 'Revenue (VNĐ)'
            }
        }
    };

    const revenueChart = new ApexCharts(document.querySelector("#revenue-chart"), chartOptions);
    revenueChart.render();

    const filterChart = async () => {
        const startDate = document.getElementById("start-date").value;
        const endDate = document.getElementById("end-date").value;

        if (!startDate || !endDate) {
            alert("Vui lòng chọn đầy đủ ngày bắt đầu và ngày kết thúc.");
            return;
        }

        if (new Date(startDate) > new Date(endDate)) {
            alert("Ngày bắt đầu không được lớn hơn ngày kết thúc.");
            return;
        }

        try {
            // Gọi API để lấy dữ liệu
            const response = await fetch('/admin/api/orders/revenue');

            if (!response.ok) {
                throw new Error("Failed to fetch data");
            }

            const data = await response.json();
            console.log("Fetched Data:", data);

            // Lọc dữ liệu theo ngày
            const filteredData = data.filter(item =>
                item.date >= startDate && item.date <= endDate
            );

            const newCategories = filteredData.map(item => item.date);
            const newData = filteredData.map(item => parseFloat(item.revenue));

            // Tính tổng doanh thu
            const totalRevenue = newData.reduce((acc, curr) => acc + curr, 0);

            // Cập nhật tổng doanh thu trong giao diện
            document.getElementById("total-revenue").textContent = totalRevenue.toLocaleString("vi-VN", { minimumFractionDigits: 2 });

            // Cập nhật biểu đồ
            revenueChart.updateOptions({
                series: [
                    {
                        name: 'Revenue',
                        data: newData
                    }
                ],
                xaxis: {
                    categories: newCategories
                }
            });
        } catch (error) {
            console.error("Error fetching data:", error);
            alert("Có lỗi xảy ra khi lấy dữ liệu.");
        }
    };

    const filterWeek = async () => {
        const today = new Date();
        const startOfWeek = new Date(today.setDate(today.getDate() - today.getDay()));
        const endOfWeek = new Date(today.setDate(today.getDate() - today.getDay() + 6));

        const startDate = startOfWeek.toISOString().split('T')[0];
        const endDate = endOfWeek.toISOString().split('T')[0];

        document.getElementById("start-date").value = startDate;
        document.getElementById("end-date").value = endDate;

        filterChart();
    };

    const filterMonth = async () => {
        const today = new Date();
        const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);

        const startDate = startOfMonth.toISOString().split('T')[0];
        const endDate = endOfMonth.toISOString().split('T')[0];

        document.getElementById("start-date").value = startDate;
        document.getElementById("end-date").value = endDate;

        filterChart();
    };

    const filterYear = async () => {
        const today = new Date();
        const startOfYear = new Date(today.getFullYear(), 0, 1);
        const endOfYear = new Date(today.getFullYear(), 11, 31);

        const startDate = startOfYear.toISOString().split('T')[0];
        const endDate = endOfYear.toISOString().split('T')[0];

        document.getElementById("start-date").value = startDate;
        document.getElementById("end-date").value = endDate;

        filterChart();
    };
    window.filterChart = filterChart;
    window.filterWeek = filterWeek;
    window.filterMonth = filterMonth;
    window.filterYear = filterYear;
    filterMonth();
});

