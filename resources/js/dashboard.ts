import { Chart } from "chart.js/auto";
import $ from "jquery";

declare global {
    const cashflows: {
        id: number,
        title: string,
        amount: number,
        type: boolean,
        info?: string | null,
        created_at?: string | null,
        updated_at?: string | null,
    }[];
    const quarters: string[];
    function rupiah(value: number | bigint): string;
}

const getYears = () => {
    let data: number[] = [];
    cashflows.forEach(e => {
        const _temp = new Date(e.created_at as string).getFullYear();
        if (!data.includes(_temp)) {
            data.push(_temp);
        }
    });
    return data.reverse();
};

const years = getYears();


class MainChart {
    constructor(year: number = 0) {
        this.year = year;

        this.setBalance();
        this.setCredit();
        this.setDebit();
    }

    private canvas = <HTMLCanvasElement>document.getElementById('chart');
    private ctx = this.canvas.getContext('2d');

    private creditHTML = <HTMLInputElement>document.getElementById('credit');
    private debitHTML = <HTMLInputElement>document.getElementById('debit');
    private balanceHTML = <HTMLInputElement>document.getElementById('balance');

    private credit: number[] = [];
    private debit: number[] = [];
    private balance: number[] = [];

    private totalCredit: number;
    private totalDebit: number;
    private totalBalance: number;

    public year: number;

    private chartData = new Chart(
        this.ctx as CanvasRenderingContext2D,
        {
            type: 'line',
            data: {
                labels: quarters,
                datasets: [
                    {
                        label: 'Saldo',
                        data: this.balance,
                        borderColor: 'rgba(77, 78, 255, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Kredit',
                        data: this.credit,
                        borderColor: 'rgba(77, 254, 80, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Debit',
                        data: this.debit,
                        borderColor: 'rgba(255, 80, 80, 1)',
                        borderWidth: 1
                    }
                ]
            }
        }
    );

    public update() {
        this.setBalance();
        this.setCredit();
        this.setDebit();
    }

    private setBalance() {
        let balance: number[] = [];
        this.totalBalance = 0;
        cashflows.filter(e => {
            return new Date(e.created_at as string).getFullYear() == this.year;
        }).sort((a, b) => {
            return new Date(a.created_at as string).getTime() - new Date(b.created_at as string).getTime();
        }).forEach(e => {
            const n: number = Math.floor(new Date(e.created_at as string).getMonth() / 3);
            if (isNaN(balance[n]))
                balance[n] = 0;
            if (e.type)
                balance[n] += e.amount;
            else
                balance[n] -= e.amount;
        });

        this.balance = Array.from(balance, (_, i) => {
            if (!(i in balance)) return 0;
            else return balance[i];
        });

        this.balance.forEach(e => {
            this.totalBalance += e;
        });

        this.balanceHTML.value = rupiah(this.totalBalance);

        this.chartData.data.datasets[0].data = this.balance;
        this.chartData.update();
    }
    private setCredit() {
        let credit: number[] = [];
        this.totalCredit = 0;
        cashflows.filter(e => {
            return new Date(e.created_at as string).getFullYear() == this.year;
        }).sort((a, b) => {
            return new Date(a.created_at as string).getTime() - new Date(b.created_at as string).getTime();
        }).forEach(e => {
            const n: number = Math.floor(new Date(e.created_at as string).getMonth() / 3);
            if (isNaN(credit[n]))
                credit[n] = 0;
            if (e.type)
                credit[n] += e.amount;
        });

        this.credit = Array.from(credit, (_, i) => {
            if (!(i in credit)) return 0;
            else return credit[i];
        });

        this.credit.forEach(e => {
            this.totalCredit += e;
        });

        this.creditHTML.value = rupiah(this.totalCredit);

        this.chartData.data.datasets[1].data = this.credit;
        this.chartData.update();
    }
    private setDebit() {
        let debit: number[] = [];
        this.totalDebit = 0;
        cashflows.filter(e => {
            return new Date(e.created_at as string).getFullYear() == this.year;
        }).sort((a, b) => {
            return new Date(a.created_at as string).getTime() - new Date(b.created_at as string).getTime();
        }).forEach(e => {
            const n: number = Math.floor(new Date(e.created_at as string).getMonth() / 3);
            if (isNaN(debit[n]))
                debit[n] = 0;
            if (!e.type)
                debit[n] += e.amount;
        });

        this.debit = Array.from(debit, (_, i) => {
            if (!(i in debit)) return 0;
            else return debit[i];
        });


        this.debit.forEach(e => {
            this.totalDebit += e;
        });

        this.debitHTML.value = rupiah(this.totalDebit);

        this.chartData.data.datasets[2].data = this.debit;
        this.chartData.update();
    }
}

let chart_1: MainChart;

(async function () {
    $('#year')[0].innerHTML = '';
    years.forEach(e => {
        $('#year')[0].innerHTML += `<option value="${e}">${e}</option>`;
    });

    chart_1 = new MainChart(years[0]);

    $('#year')[0].addEventListener('change', ev => {
        const year = $('#year').val();

        chart_1.year = Number(year);
        chart_1.update();
    });
})();
