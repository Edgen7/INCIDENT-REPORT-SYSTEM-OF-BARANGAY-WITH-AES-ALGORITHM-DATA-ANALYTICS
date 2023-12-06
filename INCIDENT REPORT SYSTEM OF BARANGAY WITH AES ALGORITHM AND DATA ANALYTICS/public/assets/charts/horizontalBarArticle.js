//setup
const dataArticle = {
    labels: article_no,
    datasets: [{
        axis: 'y',
        label: 'Total number of cases',
        data: article_count,
        fill: false,
        backgroundColor: '#C23B21',
        borderColor: '#333333',
        borderWidth: 1
    }]
};

// Function to get kp_casename based on index
function getKPCaseName(index) {
    // Replace this logic with how you access kp_casename based on index
    // For example:
    return kp_casename[index]; // Assuming kp_casename is your other variable
}

//config
const configArticle = {
    type: 'bar',
    data: dataArticle,
    options: {
        indexAxis: 'y',
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const articleIndex = context.dataIndex;
                        const articleLabel = article_no[articleIndex];
                        const articleCount = article_count[articleIndex];
                        const kp_casenameValue = getKPCaseName(articleIndex);
                        return `${articleLabel} - ${kp_casenameValue} : ${articleCount}`;
                    }
                }
            }
        }
    }
};

// render init block
const horizontalBarArticle = new Chart(
    document.getElementById('horizontalBarArticle'),
    configArticle
);