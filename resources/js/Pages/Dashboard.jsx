import React, { useState } from "react";

const Dashboard = () => {
    const [number, setNumber] = useState("1");
    return (
        <div>
            <h1 className="text-2xl font-bold mb-4">Dashboard {number}</h1>
        </div>
    );
};

export default Dashboard;
