
    function exportLocalStorageToSQL() {
        const localStorageData = {};
        for (let i = 0; i < localStorage.length; i++) {
            const key = localStorage.key(i);
            const value = localStorage.getItem(key);
            localStorageData[key] = value;
        }

        let sqlStatements = "CREATE TABLE localStorageData (key TEXT, value TEXT);\n";
        for (const key in localStorageData) {
            const value = localStorageData[key].replace(/'/g, "''");
            sqlStatements += `INSERT INTO localStorageData (key, value) VALUES ('${key}', '${value}');\n`;
        }

        const blob = new Blob([sqlStatements], { type: "text/sql" });
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "localStorageData.sql";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    document.getElementById('export-sql-button').addEventListener('click', exportLocalStorageToSQL);
