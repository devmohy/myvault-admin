export default [
  {
    title: "business name",
    dataIndex: "business_name",
    key: "business_name",
    sort: true,
  },
  {
    title: "email address",
    dataIndex: "email",
    key: "email",
    sort: true,
  },
  {
    title: "phone number",
    dataIndex: "phone_number",
    key: "phone_number",
    sort: true,
  },
  {
    title: "owner name",
    dataIndex: "owner_name",
    key: "owner_name",
    sort: true,
  },
  {
    title: "date created",
    dataIndex: "date_created",
    key: "date_created",
    sort: true,
  },
  {
    title: "Status",
    dataIndex: "status",
    key: "status",
    sort: true,
    render: function (status) {
      return h(StatusBadge, { status });
    },
  },
];