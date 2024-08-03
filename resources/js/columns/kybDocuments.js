export default [
    {
        title: "DOCUMENT NAME",
        dataIndex: "document_name",
        key: "document_name",
        sort: true,
    },
    {
        title: "MAX SIZE",
        dataIndex: "document_size",
        key: "document_size",
        sort: true,
    },
    {
        title: "TYPE",
        dataIndex: "document_type",
        key: "document_type",
        sort: true,
    },
    {
        title: "MANDATORY",
        dataIndex: "mandatory",
        key: "mandatory",
        sort: true,
        render: function (mandatory) {
        return h(StatusBadge, { mandatory });
        },
    },
    {
        title: "date created",
        dataIndex: "date_created",
        key: "date_created",
        sort: true,
    },
];
