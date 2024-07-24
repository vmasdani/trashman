export const fetchUsers = async () => {
  try {
    const resp = await fetch(`${import.meta.env.VITE_APP_BASE_URL}/api/users`);

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any[];
  } catch (e) {
    return [];
  }
};

export const fetchUser = async (params: { id: any }) => {
  try {
    const resp = await fetch(
      `${import.meta.env.VITE_APP_BASE_URL}/api/users/${params.id}`
    );

    if (resp.status !== 200) {
      throw await resp.text();
    }

    return (await resp.json()) as any;
  } catch (e) {
    return [];
  }
};
