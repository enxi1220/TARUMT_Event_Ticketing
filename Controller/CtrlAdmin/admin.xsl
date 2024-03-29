<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:fo="http://www.w3.org/1999/XSL/Format">

    <!--//    Author     : Ong Wi Lin-->

  <xsl:template match="/">
    <html>
      <head>
        <style>
          table {
            border-collapse: collapse;
            width: 100%;
            font-family: Calibri, sans-serif;
          }
          th, td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 10px;
          }
          th { 
            font-weight: bold;
          }
          h2 {
            font-family: Calibri, sans-serif;
            font-size: 20px;
          }
        small{
            font-family: Calibri, sans-serif;
            font-size: 10px;
            }
        </style>
      </head>
      <body>
        <h2>Admin / Staff Record</h2>
        <table>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Phone</th>
            <th>Mail</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Created By</th>
            <th>Updated Date</th>
            <th>Updated By</th>
          </tr>
          <xsl:for-each select="admins/admin">
            <tr>
              <td>
                <xsl:value-of select="admin_id"/>
              </td>
              <td>
                <xsl:value-of select="name"/>
              </td>
              <td>
                <xsl:value-of select="username"/>
              </td>
              <td>
                <xsl:value-of select="role"/>
              </td>
              <td>
                <xsl:value-of select="phone"/>
              </td>
              <td>
                <xsl:value-of select="mail"/>
              </td>
              <td>
                <xsl:value-of select="status"/>
              </td>
              <td>
                <xsl:value-of select="created_date"/>
              </td>
              <td>
                <xsl:value-of select="created_by"/>
              </td>
              <td>
                <xsl:value-of select="updated_date"/>
              </td>
              <td>
                <xsl:value-of select="updated_by"/>
              </td>
            </tr>
          </xsl:for-each>
        </table>
        <footer>
          <small>Generated by TAR UMT Event Ticketing System</small>
        </footer>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
